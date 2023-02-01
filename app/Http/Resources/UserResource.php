<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'full_name' => $this->full_name,   
            'email' => $this->email,      
            'password' => $this->password, 
            'address' => $this->address, 
            'contact' => $this->contact, 
            'next_of_kin_fullname' => $this->next_of_kin_fullname, 
            'next_of_kin_address' => $this->next_of_kin_address,
            'next_of_kin_contact' => $this->next_of_kin_contact,  
            'balance'=>$this->balance,
            'subscription'=>$this->subscription
  

           

        ];
    }
}
