<?php

namespace App\Policies;

use App\Models\Pasien;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PasienPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true; // Siapa pun yang login bisa melihat daftar pasien
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Pasien $pasien): bool
    {
        return true; // Siapa pun yang login bisa melihat detail pasien
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true; // Siapa pun yang login bisa membuat pasien
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Pasien $pasien): bool
    {
        // Contoh jika Anda punya kolom user_id di tabel pasiens
        // return $user->id === $pasien->user_id;

        return true; // Untuk saat ini, siapa pun yang login bisa update
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Pasien $pasien): bool
    {
        return true; // Untuk saat ini, siapa pun yang login bisa hapus
    }
}