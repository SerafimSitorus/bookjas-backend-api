const response = await fetch('https://luthfi.wuaze.com/api/kategori/Novel', {
    method: "POST",
    headers: {
        'Content-Type': 'application/json',
        'Authorization': '123'
    },
    body: JSON.stringify({
        '_method': 'DELETE',
    })
});
const data = await response.json();
console.log(data);

const response2 = await fetch('https://luthfi.wuaze.com/api/kategori');
const data2 = await response2.json();
console.log(data2);

/**
 * ubah APP_DEBUG=false jadi true di .env
*/