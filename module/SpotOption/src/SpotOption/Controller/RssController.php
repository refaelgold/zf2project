<?php

namespace SpotOption\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;


//this is for the RSS
use Zend\Feed\Reader\Reader;
use Zend\Feed\Reader\Exception\RuntimeException;




class RssController extends AbstractActionController
{


    //this need to be RSS reader
    public function indexAction()
    {


// Fetch the latest Slashdot headlines
        try {
            $slashdotRss =
                Reader::import('http://rss.cnn.com/rss/edition_technology.rss');
        } catch (RuntimeException $e) {
            // feed import failed
            echo "Exception caught importing feed: {$e->getMessage()}\n";
            exit;
        }

// Initialize the channel/feed data array
        $channel = array(
            'title'       => $slashdotRss->getTitle(),
            'link'        => $slashdotRss->getLink(),
            'description' => $slashdotRss->getDescription(),
            'items'       => array()
        );

// Loop over each channel item/entry and store relevant data $paramfor each
        foreach ($slashdotRss as $item) {
            $channel['items'][] = array(
                'title'       => $item->getTitle(),
                'link'        => $item->getLink(),
                'description' => $item->getDescription()
            );
        }


        return new ViewModel(array(
            'channel' => $channel,

        ));
    }




}

