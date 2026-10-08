<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function store(Request $request): JsonResponse|RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'project_type' => 'nullable|string|max:100',
            'budget' => 'nullable|string|max:100',
            'message' => 'required|string|min:10|max:5000',
        ]);

        $validated['ip_address'] = $request->ip();

        ContactMessage::create($validated);

        $successMessage = 'Thank you for reaching out! Your message has been received. I will review your proposal and respond promptly within 24 hours.';

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => $successMessage,
            ]);
        }

        return redirect()->to(url()->previous().'#work-together')
            ->with('success', $successMessage);
    }
}
