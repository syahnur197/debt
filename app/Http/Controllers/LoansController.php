<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Loan;
use App\User;
use App\Document;
use App\Like;
use App\Http\Resources\LoanResource;

class LoansController extends Controller
{

  public function __construct() {
    $this->middleware('auth')->except(['show', 'paginate', 'liked', 'unliked']);
    $this->middleware('owner')->only('edit', 'update');
  }

  /**
   * Display a listing of the users' loan statements
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $user_id = auth()->user()->id;
    $user = User::find($user_id);
    $data['loans'] = $user->loans;
    return view('loans.index', $data);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return view('loans.create');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    // return $request;
    $this->validate($request, [
      'debtor_name' => 'required|regex:/^[\pL\s\-]+$/u|max:200',
      'debtor_ic' => 'nullable|alpha_dash',
      'debtor_phone' => 'required|digits:7',
      'debtor_address' => 'nullable|regex:/^[0-9A-Za-z\s\-]+$/|max:200',
      'photo' => 'nullable|file|image|max:20000',
      'amount' => 'required|numeric',
      'loan_date' => 'nullable|date_format:"Y-m-d"',
      'payback_date' => 'nullable|date_format:"Y-m-d"',
      'guarantor_name' => 'nullable|regex:/^[\pL\s\-]+$/u|max:200',
      'guarantor_ic_no' => 'nullable|alpha_dash',
      'note' => 'nullable|max:2000',
      'document.*' => 'required|file|image|max:20000'
    ]);

    $data = Input::all();
    $data['user_id'] = Auth::id();

    
    $data['photo'] = "uploads/user.png";
    $loan = Loan::create($data);

    if ($request->hasFile('photo'))
    {
      $loandId = $loan->id;
      // get filename with extension
      $filenameWithExt = $request->file('photo')->getClientOriginalName();

      // get just the filename
      $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);

      $extension = $request->file('photo')->getClientOriginalExtension();
      
      // create new filename
      $filenameToStore = $filename.'_'.time().'.'.$extension;

      // upload image
      $path = $request->file('photo')->storeAs('public/photos/'.$loandId, $filenameToStore);

      $loan->photo = 'photos/'.$loandId . '/' . $filenameToStore;
      $loan->save();
    }
    $files = $request->file('document');
    if (count($files) > 0)
    {
      foreach($files as $file) {
        $loandId = $loan->id;
        $filenameWithExt = $file->getClientOriginalName();
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        $extension = $file->getClientOriginalExtension();
        $filenameToStore = $filename.'_'.time().'.'.$extension;
        $path = $file->storeAs('public/photos/'.$loandId, $filenameToStore);
        $doc = new Document;
        $doc->loan_id = $loandId;
        $doc->document = 'photos/'.$loandId . '/' . $filenameToStore;
        $doc->save();
      }
    }

    return redirect('dashboard')->with('success', 'Loan added successfully!');
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    $loan = Loan::find($id);
    if(!$loan) {
      return redirect('/dashboard');
    }
    $data['loan'] = Loan::with('User', 'Documents', 'Likes')->find($id);
    $data['share'] = \Share::currentPage($data['loan']->debtor_name.' loaned BND '. $loan->amount . ' from ' . $loan->user->name, [], '<div id="social-links" class="row"><ul class="mx-auto pr-5">','</ul></div>')
      ->facebook()
      ->twitter()
      ->googlePlus();
    // return $data;
    return view('loans.view', $data);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    $data['loan'] = Loan::with('User', 'Documents')->find($id);
    return view('loans.edit', $data);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
    $this->validate($request, [
      'debtor_name' => 'required|regex:/^[\pL\s\-]+$/u|max:200',
      'debtor_ic' => 'nullable|alpha_dash',
      'debtor_phone' => 'required|digits:7',
      'debtor_address' => 'nullable|regex:/^[0-9A-Za-z\s\-]+$/|max:200',
      'photo' => 'nullable|file|image|max:20000',
      'amount' => 'required|numeric',
      'loan_date' => 'nullable|date_format:"Y-m-d"',
      'payback_date' => 'nullable|date_format:"Y-m-d"',
      'guarantor_name' => 'nullable|regex:/^[\pL\s\-]+$/u|max:200',
      'guarantor_ic_no' => 'nullable|alpha_dash',
      'note' => 'nullable|max:2000',
      'document.*' => 'required|file|image|max:20000'
    ]);

    $loan = Loan::find($id);
    $data = [
      'debtor_name' => '',
      'debtor_ic' => '',
      'debtor_phone' => '',
      'debtor_address' => '',
      'amount' => '',
      'loan_date' => '',
      'payback_date' => '',
      'guarantor_name' => '',
      'guarantor_ic_no' => '',
      'note' => '',
    ];
    foreach($data as $key => $value) {
      $data[$key] = $request->input($key);
    }
    $loan->update($data);

    if ($request->hasFile('photo'))
    {
      if (Storage::disk('public')->exists( '/'.$loan->photo )) {
        Storage::disk('public')->delete('/'.$loan->photo );
      }
      $loandId = $loan->id;
      // get filename with extension
      $filenameWithExt = $request->file('photo')->getClientOriginalName();

      // get just the filename
      $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);

      $extension = $request->file('photo')->getClientOriginalExtension();
      
      // create new filename
      $filenameToStore = $filename.'_'.time().'.'.$extension;

      // upload image
      $path = $request->file('photo')->storeAs('public/photos/'.$loandId, $filenameToStore);

      $loan->photo = 'photos/'.$loandId . '/' . $filenameToStore;
      $loan->save();
    }
    $files = $request->file('document');
    if ($files)
    {
      foreach($files as $file) {
        $loandId = $loan->id;
        $filenameWithExt = $file->getClientOriginalName();
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        $extension = $file->getClientOriginalExtension();
        $filenameToStore = $filename.'_'.time().'.'.$extension;
        $path = $file->storeAs('public/photos/'.$loandId, $filenameToStore);
        $doc = new Document;
        $doc->loan_id = $loandId;
        $doc->document = 'photos/'.$loandId . '/' . $filenameToStore;
        $doc->save();
      }
    }

    return redirect('/loans/'.$id)->with('success', 'Loan details updated successully!');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    //
  }

  public function paginate()
  {
    return LoanResource::collection(Loan::paginate(6));
  }

  public function liked(Request $request) {
    $loan_id = $request->input('loan_id');
    $user_id = $request->input('user_id');

    $like = Like::where(['loan_id' => $loan_id, 'user_id' => $user_id])->get();
    
    if(count($like) > 0) {
      return response()->json([
        'success' => FALSE, 'message' => 'You already liked this!'
      ]);
    }

    $like = new Like;
    $like->loan_id = $loan_id;
    $like->user_id = $user_id;
    $success = $like->save();

    $message = "Fail to like!";
    if ($success) {
      $message = "Liked!";
    }
    $like = Like::where(['loan_id' => $loan_id])->get();
    return response()->json([
      'success' => $success, 'message' => $message, 'count' => count($like)
    ]);
  }

  public function unliked(Request $request) {
    $loan_id = $request->input('loan_id');
    $user_id = $request->input('user_id');

    $success = Like::where(['loan_id' => $loan_id, 'user_id' => $user_id])->delete();

    $message = "Fail to unlike!";
    if ($success) {
      $message = "Unliked!";
    }
    $like = Like::where(['loan_id' => $loan_id])->get();
    return response()->json([
      'success' => $success, 'message' => $message, 'count' => count($like)
    ]);
  }
}
