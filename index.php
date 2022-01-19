<script type="module">
  // Import the functions you need from the SDKs you need
  import { initializeApp } from "https://www.gstatic.com/firebasejs/9.6.3/firebase-app.js";
  import { getAnalytics } from "https://www.gstatic.com/firebasejs/9.6.3/firebase-analytics.js";
  // TODO: Add SDKs for Firebase products that you want to use
  // https://firebase.google.com/docs/web/setup#available-libraries

  // Your web app's Firebase configuration
  // For Firebase JS SDK v7.20.0 and later, measurementId is optional
  const firebaseConfig = {
    apiKey: "AIzaSyAfOuE-Rsl3DlhJUbHwRLOUObxZJmfZabc",
    authDomain: "pwa-chat-mit-nfc.firebaseapp.com",
    databaseURL: "https://pwa-chat-mit-nfc-default-rtdb.europe-west1.firebasedatabase.app",
    projectId: "pwa-chat-mit-nfc",
    storageBucket: "pwa-chat-mit-nfc.appspot.com",
    messagingSenderId: "889020811903",
    appId: "1:889020811903:web:954a774f9cb75904684d4a",
    measurementId: "G-HNGHLLYX6H"
  };

  // Initialize Firebase
  const app = initializeApp(firebaseConfig);
  const analytics = getAnalytics(app);

  var myName = prompt("Enter your name");
</script>

<!-- create a form to send message -->
<form onsubmit="return sendMessage();">
    <input id="message" placeholder="Enter message" autocomplete="off">

    <input type="submit">
</form>

<script>
    function sendMessage() {
        // get message
        var message = document.getElementById("message").value;

        // save in database
        firebase.database().ref("messages").push().set({
            "sender": myName,
            "message": message
        });

        // prevent form from submitting
        return false;
    }
</script>

<!-- create a list -->
<ul id="messages"></ul>

<script>
    // listen for incoming messages
    firebase.database().ref("messages").on("child_added", function (snapshot) {
        var html = "";
        // give each message a unique ID
        html += "<li id='message-" + snapshot.key + "'>";
        // show delete button if message is sent by me
        if (snapshot.val().sender == myName) {
            html += "<button data-id='" + snapshot.key + "' onclick='deleteMessage(this);'>";
                html += "Delete";
            html += "</button>";
        }
        html += snapshot.val().sender + ": " + snapshot.val().message;
        html += "</li>";

        document.getElementById("messages").innerHTML += html;
    });
</script>

function deleteMessage(self) {
    // get message ID
    var messageId = self.getAttribute("data-id");

    // delete message
    firebase.database().ref("messages").child(messageId).remove();
}

// attach listener for delete message
firebase.database().ref("messages").on("child_removed", function (snapshot) {
    // remove message node
    document.getElementById("message-" + snapshot.key).innerHTML = "This message has been removed";
});
