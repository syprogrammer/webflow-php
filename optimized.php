<?php
header('Content-Type:application/json');
header('Access-control-Allow-Origin: *');

//api call function



function blogapi($collectionid, $token)
{
    $curl = curl_init();

    curl_setopt_array($curl, [
        CURLOPT_URL => "https://api.webflow.com/collections/$collectionid/items",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => [
            "accept: application/json",
            "authorization: Bearer $token"
        ],
    ]);

    $response = curl_exec($curl);
    $err = curl_error($curl);
}

$blogcollectionid = '6475ae8d7697e6b0c0d28cfe';
$blogtoken = "authorization: Bearer bca210c02bfc95656dc4dedef489838a369fd5792c79770d2d0da86a7b6afc55";
blogapi($blogcollectionid, $blogtoken);



$catcollectionid = "6477295fb9047f0ddf589bb2";
$cattoken = "authorization: Bearer bca210c02bfc95656dc4dedef489838a369fd5792c79770d2d0da86a7b6afc55";
// cattoken = ad271c28bc4775858cf68186e4fd68b6b3f46365289a94f06f82f91642156cdd
//get category data api call
curl_setopt_array($curl, [
    CURLOPT_URL => "https://api.webflow.com/collections/6477295fb9047f0ddf589bb2/items",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => [
        "accept: application/json",
        "authorization: Bearer ad271c28bc4775858cf68186e4fd68b6b3f46365289a94f06f82f91642156cdd"
    ],
]);

$rescat = curl_exec($curl);
$caterr = curl_error($curl);
$rescatsarr = json_decode($rescat, true);

curl_close($curl);

//if data is successfully retrived performing next operation
if ($err) {
    echo "cURL Error #:" . $err;
} else {
    $arr = json_decode($response, true);

    $blogarr = array();


    for ($i = 0; $i <= 5; $i++) {


        $catarr = array();
        $cats = $arr['items'][$i]['categories-2'];



        foreach ($cats as $c) {

            foreach ($rescatsarr['items'] as $cat) {
                if ($cat['_id'] == $c) {
                    array_push($catarr, $cat['name']);
                }
            }
        }

        $strcatarr = implode(', ', $catarr);
        $postid = $arr['items'][$i]['_id'];
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => "https://syhost.000webhostapp.com/blogput.php",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "{\"fields\":{\"id\":\"$postid\"post-summary\":\"$strcatarr\"}}",
            CURLOPT_HTTPHEADER => [
                "accept: application/json",
                "authorization: Bearer 1abf0a43a28577c22b0cab7336be859b626d38968e68f04544361ed61c400287",
                "content-type: application/json"
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        $blogarr[$i] = array();
        $blogarr[$i]['id'] = $arr['items'][$i]['_id'];
        $blogarr[$i]['name'] = $arr['items'][$i]['name'];
        $blogarr[$i]['imgurl'] = $arr['items'][$i]['main-image']['url'];
        $blogarr[$i]['summary'] = $arr['items'][$i]['post-summary'];
        $blogarr[$i]['categories'] = $catarr;
        // $blogarr[$i]['categories'] = $arr['items'][$i]['categories-2'];

    }

    echo json_encode($blogarr);
}
