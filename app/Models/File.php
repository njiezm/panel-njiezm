<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class File extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'original_name',
        'mime_type',
        'path',
        'size',
        'folder',
        'description',
        'is_public',
        'share_token',
        'shared_at',
        'user_id',
        'type', // Ajout du nouveau type
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'size' => 'integer',
        'is_public' => 'boolean',
        'shared_at' => 'datetime',
    ];

    /**
     * Get the user that owns the file.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope a query to only include files.
     */
    public function scopeFiles($query)
    {
        return $query->where('type', 'file');
    }

    /**
     * Scope a query to only include folders.
     */
    public function scopeFolders($query)
    {
        return $query->where('type', 'folder');
    }

    /**
     * Check if the entry is a folder.
     */
    public function isFolder()
    {
        return $this->type === 'folder';
    }

    /**
     * Check if the entry is a file.
     */
    public function isFile()
    {
        return $this->type === 'file';
    }

    /**
     * Check if the file is an image.
     *
     * @return bool
     */
    public function isImage()
    {
        return $this->isFile() && strpos($this->mime_type, 'image/') === 0;
    }

    /**
     * Check if the file is a PDF.
     *
     * @return bool
     */
    public function isPdf()
    {
        return $this->isFile() && $this->mime_type === 'application/pdf';
    }

    /**
     * Get the file extension.
     *
     * @return string
     */
    public function getExtension()
    {
        return pathinfo($this->original_name, PATHINFO_EXTENSION);
    }

    /**
     * Get the formatted size of the file.
     *
     * @return string
     */
    public function getFormattedSizeAttribute()
    {
        // Les dossiers n'ont pas de taille
        if ($this->isFolder()) {
            return '—';
        }
        
        $bytes = $this->size;
        
        if ($bytes === null || $bytes === '' || !is_numeric($bytes)) {
            return '—';
        }

        $bytes = (float) $bytes;

        if ($bytes <= 0) {
            return '0 Bytes';
        }

        $k = 1024;
        $sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
        $i = (int) floor(log($bytes, $k));

        return round($bytes / pow($k, $i), 2) . ' ' . $sizes[$i];
    }

    /**
     * Generate a unique share token.
     *
     * @return string
     */
    public static function generateShareToken()
    {
        do {
            $token = Str::random(32);
        } while (self::where('share_token', $token)->exists());

        return $token;
    }
}