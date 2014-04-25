<?php
$this->set('channelData', array(
    'title' => __("Most Recent Posts"),
    'link' => $this->Html->url('/', true),
    'description' => __("Most recent posts."),
    'language' => 'en-us'
));

foreach ($posts as $post) {
    $postTime = strtotime($post['Issue']['created']);
    
    $postLink = array(
        'controller' => 'issues',
        'action' => 'view',
        $post['Issue']['id']
    );

    // Remove & escape any HTML to make sure the feed content will validate.
    $bodyText = h(strip_tags($post['Issue']['body']));
    $bodyText = $this->Text->truncate($bodyText, 400, array(
        'ending' => '...',
        'exact'  => true,
        'html'   => true,
    ));

    echo  $this->Rss->item(array(), array(
        'title' => $post['Issue']['title'],
        'link' => $postLink,
        'guid' => array('url' => $postLink, 'isPermaLink' => 'true'),
        'description' => $bodyText,
        'pubDate' => $post['Issue']['created']
    ));
}
?>