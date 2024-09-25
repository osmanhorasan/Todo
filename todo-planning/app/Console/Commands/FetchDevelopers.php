<?php
// app/Console/Commands/FetchDEvelopers.php
namespace App\Console\Commands;

use App\Models\Developer;
use Illuminate\Console\Command;
use GuzzleHttp\Client;

class FetchDevelopers extends Command
{
    protected $signature = 'developers:fetch';
    protected $description = 'Fetch developers from providers';

    public function handle()
    {
        $client = new Client();
        $providers = [
            'https://gist.githubusercontent.com/firatozpinar/18cc10a74a98b5381d169ade6d7627d9/raw/f49c19b22412be0a380d39550d3ebd23837b637c/',
        ];

        foreach ($providers as $provider) {
            try {
                $response = $client->get($provider);

                // API yanıtını kontrol et
                $jsonContent = $response->getBody()->getContents();

                // Yanıtı yazdır
                $this->info("Response from provider {$provider}: {$jsonContent}");
                // JSON verisini çözümle
                $data = json_decode($jsonContent);

                // JSON decode işleminin başarılı olup olmadığını kontrol et
                if (json_last_error() !== JSON_ERROR_NONE) {
                    $this->error("JSON decode error from provider {$provider}: " . json_last_error_msg());
                    continue; // Bir sonraki provider'a geç
                }

                // İlk API'den dönen görevler
                if (isset($data->relations->developers->data) && is_array($data->relations->developers->data)) {
                    foreach ($data->relations->developers->data as $developer) {
                        Developer::create([
                            'name' => $developer->name,
                            'duration' => $developer->time,
                            'difficulty' => $developer->level,
                            'developer_id' => $developer->id,
                        ]);
                    }
                }
                else {
                    $this->warn("No valid developer found in provider {$provider}");
                }

            } catch (\Exception $e) {
                $this->error("Error fetching from provider {$provider}: " . $e->getMessage());
            }
        }
    }
}
