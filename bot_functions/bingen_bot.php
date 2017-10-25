<?php

function bins_gen()
{
    
    return "*MasterCard*:\n" . bins_mc() . "\n\n*Visa:*\n" . bins_visa() . "\n\n*Discover:*\n" . bins_disc() . "\n\n*American Express:*\n" . bins_amex();
}

// mastercard
function mastercard()
{
    $mastercard = mt_rand(510000, 559999);
    return $mastercard;
}

function bins_mc()
{
    
    for ($i = 1; $i <= 5; $i++) {
        $bin_mc[$i] = mastercard();
    }
    return "`" . $bin_mc[1] . "xxxxxxxxxx`\n`" . $bin_mc[2] . "xxxxxxxxxx`\n`" . $bin_mc[3] . "xxxxxxxxxx`\n`" . $bin_mc[4] . "xxxxxxxxxx`\n`" . $bin_mc[5] . "xxxxxxxxxx`";
}

// visa

function visa()
{
    $visa = mt_rand(400000, 499999);
    return $visa;
}

function bins_visa()
{
    
    for ($i = 1; $i <= 5; $i++) {
        $bin_visa[$i] = visa();
    }
    return "`" . $bin_visa[1] . "xxxxxxxxxx`\n`" . $bin_visa[2] . "xxxxxxxxxx`\n`" . $bin_visa[3] . "xxxxxxxxxx`\n`" . $bin_visa[4] . "xxxxxxxxxx`\n`" . $bin_visa[5] . "xxxxxxxxxx`";
}

// american express
function amex()
{
    $amex = mt_rand(370000, 379999);
    return $amex;
}

function bins_amex()
{
    
    for ($i = 1; $i <= 5; $i++) {
        $bin_amex[$i] = amex();
    }
    return "`" . $bin_amex[1] . "xxxxxxxxx`\n`" . $bin_amex[2] . "xxxxxxxxx`\n`" . $bin_amex[3] . "xxxxxxxxx`\n`" . $bin_amex[4] . "xxxxxxxxx`\n`" . $bin_amex[5] . "xxxxxxxxx`";
}

function discover()
{
    $discover = mt_rand(644000, 659999);
    return $discover;
}

function bins_disc()
{
    
    for ($i = 1; $i <= 5; $i++) {
        $bin_disc[$i] = discover();
    }
    return "`" . $bin_disc[1] . "xxxxxxxxxx`\n`" . $bin_disc[2] . "xxxxxxxxxx`\n`" . $bin_disc[3] . "xxxxxxxxxx`\n`" . $bin_disc[4] . "xxxxxxxxxx`\n`" . $bin_disc[5] . "xxxxxxxxxx`";
}