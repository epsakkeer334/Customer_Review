<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::all();

        // foreach ($reviews as $review) {
        //     $review->sentiment = $this->getSentiment($review->review_text);
        // }

        return view('reviews.index', compact('reviews'));
    }

    public function create()
    {
        return view('reviews.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'review_text' => 'required',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $validated['sentiment'] = $this->getSentiment($validated['review_text']);

        Review::create($validated);

        return redirect()->route('reviews.index');
    }


    public function edit(Review $review)
    {
        return view('reviews.edit', compact('review'));
    }

    public function update(Request $request, Review $review)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'review_text' => 'required',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $validated['sentiment'] = $this->getSentiment($validated['review_text']);

        $review->update($validated);

        return redirect()->route('reviews.index');
    }

    public function destroy(Review $review)
    {
        $review->delete();
        return redirect()->route('reviews.index');
    }

    private function getSentiment($text)
    {
        // $response = Http::timeout(5)->post('http://localhost:8000/api/sentiment-analysis/', [
        //     'text' => $text
        // ]);
        // dd($response);
        $url = env('EXTERNAL_API_');

        try {
            $curl = curl_init();

            curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array('text' => $text),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            if ($response !== false) {
                $data = json_decode($response, true);
                if (json_last_error() === JSON_ERROR_NONE) {

                    return $data['sentiment'];
                } else {
                    // echo "Error decoding JSON: " . json_last_error_msg();
                    return 'Unknown';
                }
            } else {
                // echo "cURL error: " . curl_error($curl);
                return 'Unknown';
            }

        } catch (\Exception $e) {
            Log::error('Exception: ' . $e->getMessage());
            return 'Error';
        }
    }
}
