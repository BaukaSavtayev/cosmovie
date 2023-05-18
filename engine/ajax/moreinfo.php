<?php
$id = (int) $_GET['id'];
if (!$id) die();

$query = "SELECT short_story,xfields FROM " . PREFIX . "_post WHERE id =" . $id;
$db->query($query);
$row = $db->get_row();
$short_story = mb_strimwidth($row['short_story'], 0, 160, "...");
preg_match('/origin\|(?P<origin>\w+)\|\|/', $row['xfields'], $matches);
$origin = $matches['origin'];
preg_match('/rating-imdb\|(?P<rating>\d\.\d)/', $row['xfields'], $matches);
$rating = $matches['rating'] * 10 . '%';
echo
<<<HTML

<h4>$origin</h4>
<p>$short_story</p>
<div class="starrate">
    <div class="star-o" style="width: $rating">
        <span class="fa fa-star"></span>
        <span class="fa fa-star"></span>
        <span class="fa fa-star"></span>
        <span class="fa fa-star"></span>
        <span class="fa fa-star"></span>
        <span class="fa fa-star"></span>
        <span class="fa fa-star"></span>
        <span class="fa fa-star"></span>
        <span class="fa fa-star"></span>
        <span class="fa fa-star"></span>
    </div>
    <div class="star-fill">
        <span class="fa fa-star"></span>
        <span class="fa fa-star"></span>
        <span class="fa fa-star"></span>
        <span class="fa fa-star"></span>
        <span class="fa fa-star"></span>
        <span class="fa fa-star"></span>
        <span class="fa fa-star"></span>
        <span class="fa fa-star"></span>
        <span class="fa fa-star"></span>
        <span class="fa fa-star"></span>
    </div>
</div>
<span class="fa fa-clock-o">144 мин. / 02:24</span>

HTML;
