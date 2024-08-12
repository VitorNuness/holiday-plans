<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MessageResource extends JsonResource
{
    public function __construct(
        private string $message,
        private mixed $data = null,
    ) {}

    public function toArray(Request $request): array
    {
        return [
            'message' => $this->message,
            'data'    => $this->data,
        ];
    }
}
