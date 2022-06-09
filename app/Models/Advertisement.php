<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;

class Advertisement extends Model
{
    use HasFactory;
    protected $fillable = [
        'description',
        'price',
        'category_id',
        'titre',
        'ville',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function delete()
    {
        File::delete(public_path($this->image_url));
        /*for multi image*/
        File::delete(public_path($this->image1));
        File::delete(public_path($this->image2));
        File::delete(public_path($this->image3));
        // end
        return parent::delete();
    }

    public function save(array $options = [])
    {
        if (!$this->exists) {
            $this->user_id = Auth::id();
        }

        return parent::save();
    }

    public function updateImage($image)
    {
        if ($this->image_url != '') {
            File::delete(public_path($this->image_url));
        }

        $imageName = $this->id . '.' . $image->extension();
        $image->move(public_path('images'), $imageName);
        $this->image_url = '/images/' . $imageName;

        return parent::save();
    }
    
        //for multi image
    public function updateImage1($image)
    {
        if ($this->image_url != '') {
            File::delete(public_path($this->image1));
        }

        $imageName = $this->id . '1.' . $image->extension();
        $image->move(public_path('images'), $imageName);
        $this->image1 = '/images/' . $imageName;
        
        return parent::save();
    }
    public function updateImage2($image)
    {
        if ($this->image_url != '') {
            File::delete(public_path($this->image2));
        }

        $imageName = $this->id . '2.' . $image->extension();
        $image->move(public_path('images'), $imageName);
        $this->image2 = '/images/' . $imageName;
        
        return parent::save();
    }
    public function updateImage3($image)
    {
        if ($this->image3 != '') {
            File::delete(public_path($this->image_url));
        }

        $imageName = $this->id . '3.' . $image->extension();
        $image->move(public_path('images'), $imageName);
        $this->image3 = '/images/' . $imageName;
        
        return parent::save();
    }
        //end
}
