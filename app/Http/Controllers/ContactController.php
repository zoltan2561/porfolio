<?php

namespace App\Http\Controllers;

use App\Mail\PortfolioContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Throwable;

class ContactController extends Controller
{
    public function send(Request $request)
    {
        $lang = $request->input('lang') === 'en' ? 'en' : 'hu';

        if (filled((string) $request->input('website'))) {
            return $this->redirectWithStatus($lang, 'error');
        }

        $validator = Validator::make($request->all(), [
            'lang' => ['nullable', 'in:hu,en'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email:rfc,dns', 'max:255'],
            'message' => ['required', 'string', 'max:5000'],
            'website' => ['nullable', 'string'],
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('home', $lang === 'en' ? ['lang' => 'en'] : [])
                ->withErrors($validator)
                ->withInput()
                ->withFragment('kapcsolat');
        }

        $validated = $validator->validated();

        $toAddress = env('CONTACT_RECIPIENT_ADDRESS', config('portfolio.person.contact.email'));
        $toName = env('CONTACT_RECIPIENT_NAME', config('portfolio.person.name'));

        try {
            Mail::to($toAddress, $toName)->send(
                new PortfolioContactMessage([
                    'name' => $validated['name'],
                    'email' => $validated['email'],
                    'message' => $validated['message'],
                ], $lang)
            );
        } catch (Throwable $exception) {
            Log::warning('Portfolio contact mail failed.', [
                'message' => $exception->getMessage(),
            ]);

            return $this->redirectWithStatus($lang, 'error');
        }

        return $this->redirectWithStatus($lang, 'success');
    }

    private function redirectWithStatus(string $lang, string $status)
    {
        return redirect()
            ->route('home', $lang === 'en' ? ['lang' => 'en'] : [])
            ->with('contact_status', $status)
            ->withFragment('kapcsolat');
    }
}
