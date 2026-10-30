<?php

namespace App\Traits;

use App\Models\ActivityLog;

trait LogsActivity
{
    protected static function bootLogsActivity(): void
    {
        // Ketika data ditambahkan
        static::created(function ($model) {
            self::writeActivity(
                $model,
                'tambah',
                'Menambahkan data ' . self::modelName($model)
            );
        });

        // Ketika data diperbarui
        static::updated(function ($model) {

            $description = 'Mengubah data ' . self::modelName($model);

            // Keterangan khusus untuk pengembalian buku
            if (
                class_basename($model) === 'Loan'
                && $model->wasChanged('status')
                && $model->status === 'dikembalikan'
            ) {
                $description = 'Mengembalikan buku: '
                    . ($model->book->title ?? 'Buku tidak ditemukan');
            }

            self::writeActivity(
                $model,
                'edit',
                $description
            );
        });

        // Ketika data dihapus
        static::deleted(function ($model) {
            self::writeActivity(
                $model,
                'hapus',
                'Menghapus data ' . self::modelName($model)
            );
        });
    }

    private static function writeActivity(
        $model,
        string $action,
        string $description
    ): void {
        ActivityLog::create([
            'user_id' => auth()->id(),
            'action_type' => $action,
            'description' => $description,
        ]);
    }

    private static function modelName($model): string
    {
        return match (class_basename($model)) {
            'Book' => 'buku: ' . $model->title,
            'Category' => 'kategori: ' . $model->name,
            'Loan' => 'peminjaman ID #' . $model->id,
            default => class_basename($model),
        };
    }
}
