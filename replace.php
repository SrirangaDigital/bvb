<?php

$inFilename = $argv[1];
$contents = file_get_contents($inFilename);

$contents = str_replace("<feature>A Letter from the Bhavan's President</feature>", "<feature>Letter from the Bhavan's President</feature>", $contents);
$contents = str_replace("<feature>A Pictorial Feature</feature>", "<feature>Pictorial Feature</feature>", $contents);
$contents = str_replace("<feature>A Short Story</feature>", "<feature>Short Story</feature>", $contents);
$contents = str_replace("<feature>A Tribute</feature>", "<feature>Tribute</feature>", $contents);
$contents = str_replace("<feature>An Interview</feature>", "<feature>Interview</feature>", $contents);
$contents = str_replace("<feature>Bahvan's News</feature>", "<feature>Bhavan's News / Notes and News</feature>", $contents);
$contents = str_replace("<feature>Bhavan's Book for the Fortnight</feature>", "<feature>Book Review</feature>", $contents);
$contents = str_replace("<feature>Bhavan's Essay</feature>", "<feature>Bhavan's Essay</feature>", $contents);
$contents = str_replace("<feature>Bhavan's News</feature>", "<feature>Bhavan's News / Notes and News</feature>", $contents);
$contents = str_replace("<feature>BJ Prashnottara</feature>", "<feature>BJ Prasnottara</feature>", $contents);
$contents = str_replace("<feature>BJ Prasnottara</feature>", "<feature>BJ Prasnottara</feature>", $contents);
$contents = str_replace("<feature>Book Review</feature>", "<feature>Book Review</feature>", $contents);
$contents = str_replace("<feature>Book Shelf</feature>", "<feature>Book Review</feature>", $contents);
$contents = str_replace("<feature>Chetana</feature>", "<feature>Chetana</feature>", $contents);
$contents = str_replace("<feature>Doctor Speaks</feature>", "<feature>Doctor Speaks</feature>", $contents);
$contents = str_replace("<feature>Echoes from Eternity</feature>", "<feature>Echoes from Eternity</feature>", $contents);
$contents = str_replace("<feature>Editorial</feature>", "<feature>Editorial</feature>", $contents);
$contents = str_replace("<feature>Flash Back</feature>", "<feature>Flash Back</feature>", $contents);
$contents = str_replace("<feature>For Our Chiranjeevis</feature>", "<feature>For Our Chiranjeevis</feature>", $contents);
$contents = str_replace("<feature>From Our Readers</feature>", "<feature>From Our Readers / Readers Write / Reader.com</feature>", $contents);
$contents = str_replace("<feature>Governance — Concept & Reality</feature>", "<feature />", $contents);
$contents = str_replace("<feature>Here and There</feature>", "<feature>Here and There</feature>", $contents);
$contents = str_replace("<feature>Homage</feature>", "<feature>Obituary / Homage / In Memoriam</feature>", $contents);
$contents = str_replace("<feature>In Memoriam</feature>", "<feature>Obituary / Homage / In Memoriam</feature>", $contents);
$contents = str_replace("<feature>Interview</feature>", "<feature>Interview</feature>", $contents);
$contents = str_replace("<feature>Know Your Economy</feature>", "<feature>Know Your Economy</feature>", $contents);
$contents = str_replace("<feature>Kulapativani</feature>", "<feature>Kulapativani</feature>", $contents);
$contents = str_replace("<feature>Nandana</feature>", "<feature>Nandana</feature>", $contents);
$contents = str_replace("<feature>Notes and News</feature>", "<feature>Bhavan's News / Notes and News</feature>", $contents);
$contents = str_replace("<feature>Obituary</feature>", "<feature>Obituary / Homage / In Memoriam</feature>", $contents);
$contents = str_replace("<feature>Our Cover</feature>", "<feature>Our Cover</feature>", $contents);
$contents = str_replace("<feature>Photo Feature</feature>", "<feature>Pictorial Feature</feature>", $contents);
$contents = str_replace("<feature>Photo News</feature>", "<feature>Pictorial Feature</feature>", $contents);
$contents = str_replace("<feature>Prayer</feature>", "<feature>Prayer</feature>", $contents);
$contents = str_replace("<feature>Question Box</feature>", "<feature>Question Box</feature>", $contents);
$contents = str_replace("<feature>Reader.com</feature>", "<feature>From Our Readers / Readers Write / Reader.com</feature>", $contents);
$contents = str_replace("<feature>Readers Write</feature>", "<feature>From Our Readers / Readers Write / Reader.com</feature>", $contents);
$contents = str_replace("<feature>Recent Happening</feature>", "<feature>Miscellaneous News</feature>", $contents);
$contents = str_replace("<feature>Review Article</feature>", "<feature>Review Article</feature>", $contents);
$contents = str_replace("<feature>Saare Jahaan Se</feature>", "<feature>Miscellaneous News</feature>", $contents);
$contents = str_replace("<feature>Sage Speak</feature>", "<feature>Sage Speak</feature>", $contents);
$contents = str_replace("<feature>Sanskrit Vishva Parishad</feature>", "<feature>Bhavan's News / Notes and News</feature>", $contents);
$contents = str_replace("<feature>Shraddhanjali</feature>", "<feature>Obituary / Homage / In Memoriam</feature>", $contents);
$contents = str_replace("<feature>Special Features on Bhagawan Sri Satya Sai Baba</feature>", "<feature />", $contents);
$contents = str_replace("<feature>Supplement</feature>", "<feature>Supplement</feature>", $contents);
$contents = str_replace("<feature>They Said So</feature>", "<feature />", $contents);
$contents = str_replace("<feature>Thought for the Fornight</feature>", "<feature />", $contents);
$contents = str_replace("<feature>Thought for the Fortnight</feature>", "<feature />", $contents);
$contents = str_replace("<feature>Understanding India</feature>", "<feature />", $contents);
$contents = str_replace("<feature>Voice of Freedom</feature>", "<feature>Voice of Freedom</feature>", $contents);
$contents = str_replace("<feature>Voice of Wisdom</feature>", "<feature>Voice of Wisdom</feature>", $contents);
$contents = str_replace("<feature>Without Comment</feature>", "<feature>Without Comment</feature>", $contents);
$contents = str_replace("<feature>World of Books</feature>", "<feature>Book Review</feature>", $contents);
$contents = str_replace("<feature>Young Icons</feature>", "<feature />", $contents);

echo $contents;

?>
