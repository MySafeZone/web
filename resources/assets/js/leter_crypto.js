$(document).ready(function () {
    $('.has-spinner').click(function () {
        var btn = $(this);
        $(btn).buttonLoader('start', false);
    });
});

function generateKey() {
    if (checkGenerateKeysForm()) {
        if (confirm('Are you sure? You won\'t be able to edit recipients after generating keys.')) {

            var options = {
                numBits: 4096,
                userId: 'Leter.io <admin@leter.io>'
            };

            var openpgp = window.openpgp;

            var error_found = false;

            openpgp.generateKeyPair(options).then(
                function(keypair) {
                    var privkey = keypair.privateKeyArmored;
                    var pubkey = keypair.publicKeyArmored;
                    $("#public_key").val(pubkey);
                    var res = $("#recipients").val().split(",");
                    var keyHex = secrets.str2hex(privkey);
                    var array_shares = secrets.share(keyHex, res.length + res.length, res.length + 1);
                    $("#recipients").attr('readonly','readonly');
                    var array_shares_tosend = array_shares.slice(0,res.length);
                    var cpt = 0;
                    var content = '';
                    array_shares_tosend.forEach(
                        function(entry) {
                            content = content + '<a href="mailto:'+res[cpt]+'?body='+entry+'">Sent this email to '+res[cpt]+' from your computer</a><br />';
                            cpt++;
                        }
                    );
                    $("#list_emails").html(content);
                    $("#list_emails").show();
                    var array_shares_keep = array_shares.slice(res.length, array_shares.length);
                    $("#shares").val(array_shares_keep);
                    $("#btn_generate").attr('disabled','disabled');                
                    $("#btn_create").removeAttr('disabled');
                }
            ).catch(
                function(error) {
                    error_found = true;
                    alert("FAIL !! (generateKeyPair) " + error);
                }
            );

            setTimeout(function () {
                $("#btn_generate").buttonLoader('stop', error_found);
            }, 1000);
        }
    }
}

function checkGenerateKeysForm() {
    if ($("#title").val() == '') {
        alert("You must set a title.");
        return false;
    }

    if ($("#recipients").val() == '') {
        alert("You must set recipents.");
        return false;
    }

    if ($("#periodicity").val() == '0') {
        alert("You must set periodicity.");
        return false;
    }

    var arr_recipients = $("#recipients").val().split(",");

    var all_emails_good = true;
    arr_recipients.forEach(
        function(entry) {
            if (!validEmail(entry)) {
                alert(entry + " is not a valid email address.");
                all_emails_good =  false;
            }
        }
    );

    return all_emails_good;
}

function validEmail(v) {
    var r = new RegExp("[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?");
    return (v.match(r) == null) ? false : true;
}

function encrypt() {
    if (checkEncryptForm()) {
        var res = $("#public_key").val();
        var publicKey = openpgp.key.readArmored(res);

        var message = $("#content").val();

        var error_found = false;

        openpgp.encryptMessage(publicKey.keys, message).then(
            function(pgpMessage) {
                $("#hash_content").val(md5(message));
                $("#content").val(pgpMessage);
                $("#btn_encrypt").attr('disabled','disabled');                
                $("#btn_create").removeAttr('disabled');
            }
        ).catch(
            function(error) {
                error_found = true;
                alert("FAIL !! (encryptMessage)" + error);
            }
        );

        setTimeout(function () {
            $("#btn_encrypt").buttonLoader('stop', error_found);
        }, 1000);
    }
}

function checkEncryptForm() {
    if ($("#title").val() == '') {
        alert("You must set a title.");
        return false;
    }

    if ($("#content").val() == '') {
        alert("You must write a content.");
        return false;
    }

    return true;
}

function decrypt() {
    var shares_temp = $("#shares").val().split(",");
    shares_temp.push($("#key").val().trim());
    var shares = secrets.combine(shares_temp);
    var key = secrets.hex2str(shares);
    var privateKey = openpgp.key.readArmored(key).keys[0];

    $(".message").each(
        function(){
            var input = $(this);
            var pgpMessage = openpgp.message.readArmored(input.val());
            openpgp.decryptMessage(privateKey, pgpMessage).then(
                function(plaintext) {
                    input.val(plaintext);
                }
            ).catch(
                function(error) {
                    alert("FAIL" + error);
                }
            );
        }
    );
}