<?php


$volumes = glob('Text/*', GLOB_ONLYDIR);

foreach ($volumes as $volume) {
	
	$volume = str_replace('Text/', '', $volume);
	echo 'Processing Volume ' . $volume . "\n";

	$iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator('Text/' . $volume));

	foreach($iterator as $file => $object) {

		if(!(preg_match('/\.$/', $file))) {

			$content = file_get_contents($file);

			$content = preProcessText($content);
			
			file_put_contents($file, $content);
		}
	}
}

function preProcessText($content) {

	$content = preg_replace('/[[:^print:]]/', ' ', $content);
	// Remove all punctuations except 's
	$content = preg_replace('/[^\P{P}\']/', ' ', $content);

	$content = strtolower($content);

	// Remove Stop words
	$content = preg_replace("/\ba's\b|\bable\b|\babout\b|\babove\b|\baccording\b|\baccordingly\b|\bacross\b|\bactually\b|\bafter\b|\bafterwards\b|\bagain\b|\bagainst\b|\bain't\b|\ball\b|\ballow\b|\ballows\b|\balmost\b|\balone\b|\balong\b|\balready\b|\balso\b|\balthough\b|\balways\b|\bam\b|\bamong\b|\bamongst\b|\ban\b|\band\b|\banother\b|\bany\b|\banybody\b|\banyhow\b|\banyone\b|\banything\b|\banyway\b|\banyways\b|\banywhere\b|\bapart\b|\bappear\b|\bappreciate\b|\bappropriate\b|\bare\b|\baren't\b|\baround\b|\bas\b|\baside\b|\bask\b|\basking\b|\bassociated\b|\bat\b|\bavailable\b|\baway\b|\bawfully\b|\bbe\b|\bbecame\b|\bbecause\b|\bbecome\b|\bbecomes\b|\bbecoming\b|\bbeen\b|\bbefore\b|\bbeforehand\b|\bbehind\b|\bbeing\b|\bbelieve\b|\bbelow\b|\bbeside\b|\bbesides\b|\bbest\b|\bbetter\b|\bbetween\b|\bbeyond\b|\bboth\b|\bbrief\b|\bbut\b|\bby\b|\bc'mon\b|\bc's\b|\bcame\b|\bcan\b|\bcan't\b|\bcannot\b|\bcant\b|\bcause\b|\bcauses\b|\bcertain\b|\bcertainly\b|\bchanges\b|\bclearly\b|\bco\b|\bcom\b|\bcome\b|\bcomes\b|\bconcerning\b|\bconsequently\b|\bconsider\b|\bconsidering\b|\bcontain\b|\bcontaining\b|\bcontains\b|\bcorresponding\b|\bcould\b|\bcouldn't\b|\bcourse\b|\bcurrently\b|\bdefinitely\b|\bdescribed\b|\bdespite\b|\bdid\b|\bdidn't\b|\bdifferent\b|\bdo\b|\bdoes\b|\bdoesn't\b|\bdoing\b|\bdon't\b|\bdone\b|\bdown\b|\bdownwards\b|\bduring\b|\beach\b|\bedu\b|\beg\b|\beight\b|\beither\b|\belse\b|\belsewhere\b|\benough\b|\bentirely\b|\bespecially\b|\bet\b|\betc\b|\beven\b|\bever\b|\bevery\b|\beverybody\b|\beveryone\b|\beverything\b|\beverywhere\b|\bex\b|\bexactly\b|\bexample\b|\bexcept\b|\bfar\b|\bfew\b|\bfifth\b|\bfirst\b|\bfive\b|\bfollowed\b|\bfollowing\b|\bfollows\b|\bfor\b|\bformer\b|\bformerly\b|\bforth\b|\bfour\b|\bfrom\b|\bfurther\b|\bfurthermore\b|\bget\b|\bgets\b|\bgetting\b|\bgiven\b|\bgives\b|\bgo\b|\bgoes\b|\bgoing\b|\bgone\b|\bgot\b|\bgotten\b|\bgreetings\b|\bhad\b|\bhadn't\b|\bhappens\b|\bhardly\b|\bhas\b|\bhasn't\b|\bhave\b|\bhaven't\b|\bhaving\b|\bhe\b|\bhe's\b|\bhello\b|\bhelp\b|\bhence\b|\bher\b|\bhere\b|\bhere's\b|\bhereafter\b|\bhereby\b|\bherein\b|\bhereupon\b|\bhers\b|\bherself\b|\bhi\b|\bhim\b|\bhimself\b|\bhis\b|\bhither\b|\bhopefully\b|\bhow\b|\bhowbeit\b|\bhowever\b|\bi'd\b|\bi'll\b|\bi'm\b|\bi've\b|\bie\b|\bif\b|\bignored\b|\bimmediate\b|\bin\b|\binasmuch\b|\binc\b|\bindeed\b|\bindicate\b|\bindicated\b|\bindicates\b|\binner\b|\binsofar\b|\binstead\b|\binto\b|\binward\b|\bis\b|\bisn't\b|\bit\b|\bit'd\b|\bit'll\b|\bit's\b|\bits\b|\bitself\b|\bjust\b|\bkeep\b|\bkeeps\b|\bkept\b|\bknow\b|\bknown\b|\bknows\b|\blast\b|\blately\b|\blater\b|\blatter\b|\blatterly\b|\bleast\b|\bless\b|\blest\b|\blet\b|\blet's\b|\blike\b|\bliked\b|\blikely\b|\blittle\b|\blook\b|\blooking\b|\blooks\b|\bltd\b|\bmainly\b|\bmany\b|\bmay\b|\bmaybe\b|\bme\b|\bmean\b|\bmeanwhile\b|\bmerely\b|\bmight\b|\bmore\b|\bmoreover\b|\bmost\b|\bmostly\b|\bmuch\b|\bmust\b|\bmy\b|\bmyself\b|\bname\b|\bnamely\b|\bnd\b|\bnear\b|\bnearly\b|\bnecessary\b|\bneed\b|\bneeds\b|\bneither\b|\bnever\b|\bnevertheless\b|\bnew\b|\bnext\b|\bnine\b|\bno\b|\bnobody\b|\bnon\b|\bnone\b|\bnoone\b|\bnor\b|\bnormally\b|\bnot\b|\bnothing\b|\bnovel\b|\bnow\b|\bnowhere\b|\bobviously\b|\bof\b|\boff\b|\boften\b|\boh\b|\bok\b|\bokay\b|\bold\b|\bon\b|\bonce\b|\bone\b|\bones\b|\bonly\b|\bonto\b|\bor\b|\bother\b|\bothers\b|\botherwise\b|\bought\b|\bour\b|\bours\b|\bourselves\b|\bout\b|\boutside\b|\bover\b|\boverall\b|\bown\b|\bparticular\b|\bparticularly\b|\bper\b|\bperhaps\b|\bplaced\b|\bplease\b|\bplus\b|\bpossible\b|\bpresumably\b|\bprobably\b|\bprovides\b|\bque\b|\bquite\b|\bqv\b|\brather\b|\brd\b|\bre\b|\breally\b|\breasonably\b|\bregarding\b|\bregardless\b|\bregards\b|\brelatively\b|\brespectively\b|\bright\b|\bsaid\b|\bsame\b|\bsaw\b|\bsay\b|\bsaying\b|\bsays\b|\bsecond\b|\bsecondly\b|\bsee\b|\bseeing\b|\bseem\b|\bseemed\b|\bseeming\b|\bseems\b|\bseen\b|\bself\b|\bselves\b|\bsensible\b|\bsent\b|\bserious\b|\bseriously\b|\bseven\b|\bseveral\b|\bshall\b|\bshe\b|\bshould\b|\bshouldn't\b|\bsince\b|\bsix\b|\bso\b|\bsome\b|\bsomebody\b|\bsomehow\b|\bsomeone\b|\bsomething\b|\bsometime\b|\bsometimes\b|\bsomewhat\b|\bsomewhere\b|\bsoon\b|\bsorry\b|\bspecified\b|\bspecify\b|\bspecifying\b|\bstill\b|\bsub\b|\bsuch\b|\bsup\b|\bsure\b|\bt's\b|\btake\b|\btaken\b|\btell\b|\btends\b|\bth\b|\bthan\b|\bthank\b|\bthanks\b|\bthanx\b|\bthat\b|\bthat's\b|\bthats\b|\bthe\b|\btheir\b|\btheirs\b|\bthem\b|\bthemselves\b|\bthen\b|\bthence\b|\bthere\b|\bthere's\b|\bthereafter\b|\bthereby\b|\btherefore\b|\btherein\b|\btheres\b|\bthereupon\b|\bthese\b|\bthey\b|\bthey'd\b|\bthey'll\b|\bthey're\b|\bthey've\b|\bthink\b|\bthird\b|\bthis\b|\bthorough\b|\bthoroughly\b|\bthose\b|\bthough\b|\bthree\b|\bthrough\b|\bthroughout\b|\bthru\b|\bthus\b|\bto\b|\btogether\b|\btoo\b|\btook\b|\btoward\b|\btowards\b|\btried\b|\btries\b|\btruly\b|\btry\b|\btrying\b|\btwice\b|\btwo\b|\bun\b|\bunder\b|\bunfortunately\b|\bunless\b|\bunlikely\b|\buntil\b|\bunto\b|\bup\b|\bupon\b|\bus\b|\buse\b|\bused\b|\buseful\b|\buses\b|\busing\b|\busually\b|\bvalue\b|\bvarious\b|\bvery\b|\bvia\b|\bviz\b|\bvs\b|\bwant\b|\bwants\b|\bwas\b|\bwasn't\b|\bway\b|\bwe\b|\bwe'd\b|\bwe'll\b|\bwe're\b|\bwe've\b|\bwelcome\b|\bwell\b|\bwent\b|\bwere\b|\bweren't\b|\bwhat\b|\bwhat's\b|\bwhatever\b|\bwhen\b|\bwhence\b|\bwhenever\b|\bwhere\b|\bwhere's\b|\bwhereafter\b|\bwhereas\b|\bwhereby\b|\bwherein\b|\bwhereupon\b|\bwherever\b|\bwhether\b|\bwhich\b|\bwhile\b|\bwhither\b|\bwho\b|\bwho's\b|\bwhoever\b|\bwhole\b|\bwhom\b|\bwhose\b|\bwhy\b|\bwill\b|\bwilling\b|\bwish\b|\bwith\b|\bwithin\b|\bwithout\b|\bwon't\b|\bwonder\b|\bwould\b|\bwouldn't\b|\byes\b|\byet\b|\byou\b|\byou'd\b|\byou'll\b|\byou're\b|\byou've\b|\byour\b|\byours\b|\byourself\b|\byourselves\b|\bzero\b/", ' ', $content);
	$content = preg_replace('/\b\d\b|\b[a-zA-Z][a-zA-Z]\b|\b[a-zA-Z]\b/', ' ', $content);
	$content = preg_replace('/[\`\~\$\^\=\+\|\>\<]/', '', $content);
	$content = preg_replace('/\' /', '', $content);

	$content = preg_replace('/\h+/', ' ', $content);
	$content = preg_replace('/^\h/', '', $content);
	$content = preg_replace('/\h$/', '', $content);

	$words = explode(' ', $content);
	$words = array_unique($words, SORT_STRING);
	sort($words);

	$content = implode(' ', $words);
	$content = preg_replace('/^advertisement$/', '', $content);

	return $content;
}

?>