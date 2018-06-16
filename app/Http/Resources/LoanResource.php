<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LoanResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
          'id' => $this->id,
          'debtor_name' => ucwords($this->debtor_name),
          'debtor_ic' => $this->debtor_ic,
          'debtor_phone' => $this->debtor_phone,
          'amount' => $this->amount,
          'guarantor_name' => ucwords($this->guarantor_name),
          'loan_date' => \Carbon\Carbon::createFromFormat('Y-m-d', $this->loan_date)->format('d M Y'),
          'photo' => asset('storage/'.$this->photo),
          'note' => $this->note,
          'comment_url' => url('loans/'.$this->id.'#disqus_thread'),
          'likes' => $this->likes,
          'auth' => $this->auth(),
          'user' => [
            'name' => ucwords($this->user->name),
          ]
        ];
    }
}
