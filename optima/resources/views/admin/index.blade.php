<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @vite('resources/css/app.css')
    <title>Optima</title>
    <link rel="icon" href="https://i.ibb.co/VwtYfT6/logo.png" type="image/x-icon" />
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            position: relative;
            overflow: hidden;
        }

        .background {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('https://images.ctfassets.net/pdf29us7flmy/2ncbK2rlC2vKuQbDDaEN27/6786bc45b8272b41bf18c6d898aa6fa5/Technical-hard-skills-final-02.jpg');
            background-size: cover;
            background-position: center;
            filter: blur(5px);
            z-index: -1;
        }

        .admin-card {
            background-color: #ffffff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out;
            text-align: center;
            margin: 15px;
            max-width: 300px;
            width: 100%;
        }

        .admin-card:hover {
            transform: translateY(-5px);
        }

        .admin-card a {
            text-decoration: none;
            color: #4a90e2;
            font-weight: bold;
            transition: color 0.3s ease-in-out;
        }

        .admin-card a:hover {
            color: #1e5b9e;
        }

        .admin-card p {
            font-size: 16px;
            color: #333333;
            margin-top: 10px;
        }

        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 10px;
            position: relative;
            z-index: 1;
        }
    </style>
</head>

<body class="w-[calc(100%-3.73rem)] ml-auto">
    <aside class="fixed left-0 top-0 z-10 h-screen w-[calc(3.73rem)]">
        @include('layouts.navbar')
    </aside>

    <div class="background"></div>
    <div class="container">
        <div class="admin-card">
            <a href="{{ route('post.admin') }}">Post Tools</a>
            <p>Manage and optimize your posts with advanced tools.</p>
        </div>
        <div class="admin-card">
            <a href="{{ route('conference.admin') }}">Conference Tools</a>
            <p>Manage and optimize your conference with advanced tools.</p>
        </div>
        <div class="admin-card">
            <a href="{{ route('participant.admin') }}">Paricipant Tools</a>
            <p>Manage participant with advanced tools.</p>
        </div>
    </div>

    <footer style="position: fixed; bottom: 0; width: 1220px;">
        @include('layouts.footer')
    </footer>
</body>


</html>