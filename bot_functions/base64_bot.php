<?php

function b64_encode($dados){
	return "*Hash:* `".base64_encode($dados)."`";
}
function b64_decode($dados){
	return base64_decode(trim($dados));
}