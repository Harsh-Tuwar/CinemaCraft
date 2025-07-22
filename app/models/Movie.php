<?php
require_once 'app/models/GeminiApi.php';

class Movie {
  private $geminiApi;
  
  public function __construct() {
    $this->geminiApi = new GeminiApi($_ENV['GEMINI_API_KEY']);
  }

  public function generate_review($title) {
    $prompt = "Write a short and engaging movie review for the movie titled" . $title . ".";
    
    try {
      $response = $this->geminiApi->generateContent($prompt);
      // Adjust based on Gemini response structure
      
      $text = $response['candidates'][0]['content']['parts'][0]['text'] ?? 'No review generated.';
      return $text;
    } catch (Exception $e) {
      return 'Error generating review: ' . $e->getMessage();
    }
  }
}

?>