<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // Import the HasFactory trait
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory; // Add this line

    protected $fillable = [
        'review', 'rating'
    ];
    //
    public function book(){
        return $this->belongsTo(Book::class);
    }

    protected static function booted(){
        static::updated(fn (Review $review) => cache()->forget('book' . ':' . $review->book_id));
        static::deleted(fn (Review $review) => cache()->forget('book' . ':' . $review->book_id));
        static::created(fn(Review $review) => cache()->forget('book:' . $review->book_id));
    }
}
