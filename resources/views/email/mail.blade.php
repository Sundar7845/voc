<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Walk-in Email</title>
</head>

<body>
    <div>Total Walkin : {{ $data->count() }}</div>

    <div>Purchased customers : {{ $data->where('is_purchased', 1)->count() }}</div>
    <div>Non purchased customers : {{ $data->where('is_purchased', 0)->count() }}</div>
    <div>Scheme payment : {{ $data->where('is_scheme_joining', 1)->count() }}</div>
    <div>Scheme Redemption : {{ $data->where('is_scheme_redemption', 1)->count() }}</div>
</body>

</html>
