<!DOCTYPE html>
<html>
<head>
    <title>Reservation Expired</title>
</head>
<body>
    <h1>Hello, {{ $reservation->user->name }}</h1>

    <p>We wanted to inform you that your reservation for the book "{{ $reservation->livre->titre }}" has expired.</p>

    <p>Reservation Date: {{ $reservation->dateReservation }}</p>
    <p>Expiration Date: {{ $reservation->fin_dateReservation }}</p>

    <p>Please return the book as soon as possible.</p>

    <p>Thank you,</p>
    <p>Your Library</p>
</body>
</html>
