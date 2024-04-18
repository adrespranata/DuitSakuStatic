<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        $title = 'Duit Saku';
        $user = Auth::user();
        $userDetails = $user->userDetails;
        return view('pages.profiles.index', compact('title', 'user', 'userDetails'));
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:8',
            'confirm_password' => 'required|same:new_password',
        ], [
            'old_password.required' => 'The Old Password field is required.',
            'new_password.required' => 'The New Password field is required.',
            'new_password.min' => 'The New Password must be at least 8 characters.',
            'confirm_password.required' => 'The Confirm Password field is required.',
            'confirm_password.same' => 'The Confirm Password does not match with the New Password.',
        ]);

        try {
            // Ambil pengguna saat ini
            $user = User::findOrFail(Auth::id());

            // dd($request->all());
            // Periksa apakah kata sandi lama cocok
            if (!Hash::check($request->old_password, $user->password)) {
                throw new \Exception('Old password is incorrect.');
            }

            // Perbarui kata sandi
            $user->password = Hash::make($request->new_password);
            $user->save();

            return redirect()->back()->with('success', 'Password updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function updateDetails(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'address' => 'required|string',
            'city' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'postal_code' => 'required|string|max:20',
        ]);

        // Get the authenticated user
        $user = Auth::user();
        $userDetails = $user->userDetails;

        // Update user details
        $userDetails->updateOrCreate(
            ['user_id' => $user->id], // Condition
            $request->only('first_name', 'middle_name', 'last_name', 'address', 'city', 'country', 'postal_code')
        );

        return redirect()->back()->with('success', 'User details updated successfully.');
    }

    public function updatePicture(Request $request)
    {
        $request->validate([
            'picture' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Sesuaikan dengan kebutuhan
        ]);

        // Ambil pengguna saat ini dan detail pengguna
        $user = Auth::user();
        $userDetails = $user->userDetails;

        // Hapus gambar lama jika ada
        if ($userDetails->picture) {
            Storage::delete('img/uploaded/users/' . $userDetails->picture); // Menghapus gambar lama
        }

        // Unggah gambar baru
        if ($request->hasFile('picture')) {
            $file = $request->file('picture');
            $filename = $file->getClientOriginalName();
            $imagePath = $file->storeAs('public/img/uploaded/users', $filename);

            // Move the file to the desired directory
            $file->move(public_path('img/uploaded/users'), $filename);

            // Update the user details with the filename if the file was successfully uploaded
            if ($imagePath) {
                $userDetails->update(['picture' => $filename]);
                return redirect()->back()->with('success', 'Picture uploaded successfully.');
            } else {
                // Handle error if file upload fails
                return redirect()->back()->with('error', 'Failed to upload the picture.');
            }
        }
    }
}
