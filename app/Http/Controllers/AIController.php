<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;

class AIController extends Controller
{
    public function getAIResponse(Request $request)
    {
        try {
            $message = $request->input('message');
            $userBalance = Auth::user()->balance;

            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . config('services.openrouter.key'),
                'HTTP-Referer' => url('/'),
                'X-Title' => 'TaskMaster Pro',
                'Content-Type' => 'application/json'
            ])->post('https://openrouter.ai/api/v1/chat/completions', [
                'model' => 'meta-llama/llama-3.3-70b-instruct:free',
                'messages' => [
                    [
                        'role' => 'system',
                        'content' => "You are TaskMaster Pro's AI assistant, designed to help users understand and effectively use our task commitment platform. Here's what you need to know:
                        Core Function:
                        - Users can create tasks and attach monetary stakes to them
                        - If a task is completed by the deadline, the user gets their money back
                        - If the task is not completed, the user loses their stake
                        - Current user's balance: {$userBalance} RON

                        You can help users with:
                        1. Task Creation:
                        - Suggesting appropriate stake amounts based on task difficulty
                        - Helping set realistic deadlines
                        - Understanding the task submission process

                        2. Platform Features:
                        - Explaining how the deposit system works
                        - Clarifying the verification process for task completion
                        - Understanding the refund mechanism
                        - Navigating the dashboard and user interface})3. Best Practices:
                        - Tips for setting achievable goals
                        - Strategies for task completion
                        - How to make the most of the monetary motivation
                        - Time management advice

                        4. Technical Support:
                        - Basic troubleshooting
                        - Payment and deposit questions
                        - Account-related inquiries

                        Guidelines for responses:
                        - Be clear and concise
                        - Provide practical, actionable advice
                        - Be encouraging and motivational
                        - Focus on helping users succeed with their tasks
                        - If users ask about specific amounts, consider their current balance ({$userBalance} RON)
                        - For technical issues beyond scope, direct users to contact support
                        Remember: Your goal is to help users effectively use the platform to achieve their goals through monetary motivation.TRANSLATEEVERYTHINGINROMANIANandbeveryconciseanddontreturnmarkdownformatjustplaintext" ],

                    [
                        'role' => 'user',
                        'content' => $message
                    ]
                ]
            ]);

            if (!$response->successful()) {
                throw new \Exception('API request failed: ' . $response->status());
            }

            $data = $response->json();

            return response()->json([
                'success' => true,
                'message' => $data['choices'][0]['message']['content']
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Îmi pare rău, dar momentan nu sunt conectat la API-ul de AI. Această funcționalitate va fi implementată în curând!'
            ], 10);
        }
    }
}
