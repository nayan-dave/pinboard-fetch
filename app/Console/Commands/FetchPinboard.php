<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Pinboard;
use App\Models\Tag;

class FetchPinboard extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:fetchPinboard';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetching Data from Pinboard for specific tags';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        /* 
        * I have fixed the tags so that we dont need to fetch from DB or any config variable.
        * However, if more tags needed we can store those in DB or any config variables and fetch it from there.
        * We can also set the URL in some config variable and fetch it from there. 
        */
        
        $allowedTags = array('php','laravel','vue','vue.js','api');
        
        $url = 'https://feeds.pinboard.in/rss/u:alasdairw?per_page=120';
        $graph = \EasyRdf\Graph::newAndLoad($url, 'rdfxml');
        
        $channel = $graph->get('rss:channel', '^rdf:type');
        foreach($channel->get('rss:items') as $item) {
            
            $tagLiteral = $item->get('dc11:subject');
            $tagsString = null;
            if($tagLiteral !== null)
            {
                $tagsString = $tagLiteral->getValue();
            }
            
            if($tagsString !== null)
            {
                $tags = explode(' ',$tagsString);
                if(!empty($tags))
                {
                    $validTags = array_intersect($tags, $allowedTags);
                    
                    if(!empty($validTags))
                    {
                        $pinboard = new Pinboard;
                        $pinboard->title = $item->get('rss:title');
                        $pinboard->url = $item->get('rss:link');
                        $pinboard->description = $item->get('rss:description');
                        $pinboard->live = $this->urlExists($pinboard->url);

                        $pinboard->save();
                        foreach($validTags AS $tag)
                        {
                            $pinboardTag = new Tag;
                            $pinboardTag->tag = $tag;
                            $pinboard->tags()->save($pinboardTag);
                        }
                    }
                }
            }
        }
        
        return 0;
    }
    
    public function urlExists($url = NULL)
    {
        if ($url == NULL) return false;
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $data = curl_exec($ch);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        return ($httpcode >= 200 && $httpcode < 300) ? true : false;        
   }
}
