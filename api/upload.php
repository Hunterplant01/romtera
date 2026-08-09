<?php
function uploadImage($file) {
    $api_key = getenv('IMGBB_API_KEY');
    
    if (!$api_key) {
        return 'https://dummyimage.com/400x400/dc3545/ffffff.png&text=API+Key+Tidak+Ada';
    }

    if ($file['error'] === UPLOAD_ERR_OK) {
        $image = base64_encode(file_get_contents($file['tmp_name']));
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://api.imgbb.com/1/upload');
        curl_setopt($ch, CURLOPT_POST, 1);
        // Menggunakan http_build_query agar gambar base64 aman dikirim
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
            'key' => $api_key,
            'image' => $image
        ]));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // Mengabaikan verifikasi SSL yang sering membuat error di Vercel
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 
        curl_setopt($ch, CURLOPT_TIMEOUT, 30); // Memberi waktu ekstra
        
        $response = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);

        if ($err) {
            return 'https://dummyimage.com/400x400/dc3545/ffffff.png&text=Error+Koneksi';
        }

        $result = json_decode($response, true);
        
        if (isset($result['data']['url'])) {
            return $result['data']['url']; 
        }
    }
    
    return 'https://dummyimage.com/400x400/dc3545/ffffff.png&text=Gagal+Upload';
}
?>
