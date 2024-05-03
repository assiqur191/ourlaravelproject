import DOMPurify from "dompurify"
import axios from "axios"

export default class Chat {
  constructor() {
    this.openedYet = false
    this.chatWrapper = document.querySelector("#chat-wrapper")
    this.avatar = document.querySelector("#chat-wrapper").dataset.avatar
    this.openIcon = document.querySelector(".header-chat-icon")
    this.injectHTML()
    this.chatLog = document.querySelector("#chat")
    this.chatField = document.querySelector("#chatField")
    this.chatForm = document.querySelector("#chatForm")
    this.closeIcon = document.querySelector(".chat-title-bar-close")
    this.events()
  }

  // Events
  events() {
    this.chatForm.addEventListener("submit", e => {
      e.preventDefault()
      this.sendMessageToServer()
    })
    this.openIcon.addEventListener("click", () => this.showChat())
    this.closeIcon.addEventListener("click", () => this.hideChat())
  }

  // Methods
// Methods
sendMessageToServer() {
  const sanitizedMessage = DOMPurify.sanitize(this.chatField.value);

  axios.post("/send-chat-message", { textvalue: sanitizedMessage })
    .then(response => {
      // Handle success, if needed
      console.log("Message sent successfully");
    })
    .catch(error => {
      // Handle error
      console.error("Error sending message:", error);
    });

  // Update the chat log with the sent message
  this.chatLog.insertAdjacentHTML(
    "beforeend",
    DOMPurify.sanitize(`
      <div class="chat-self">
        <div class="chat-message">
          <div class="chat-message-inner">
            ${sanitizedMessage}
          </div>
        </div>
        <img class="chat-avatar avatar-tiny" src="/public/image/${this.avatar}">
      </div>
    `)
  );

  // Scroll to the bottom of the chat log
  this.chatLog.scrollTop = this.chatLog.scrollHeight;

  // Clear the chat field after sending the message
  this.chatField.value = "";
  this.chatField.focus();
}


  hideChat() {
    this.chatWrapper.classList.remove("chat--visible")
  }

  showChat() {
    if (!this.openedYet) {
      this.openConnection()
    }
    this.openedYet = true
    this.chatWrapper.classList.add("chat--visible")
    this.chatField.focus()
  }

  openConnection() {
    Echo.private("chatchannel").listen("ChatMassage", e => {
      this.displayMessageFromServer(e.chat)
    })
  }

 // Methods
displayMessageFromServer(data) {
  console.log("Data received from server:", data); 
  // const sanitizedMessage = DOMPurify.sanitize(data.textvalue);
  
  // this.chatLog.insertAdjacentHTML(
  //   "beforeend",
  //   DOMPurify.sanitize(`
  //     <div class="chat-other">
  //       <a href="/profile/${data.username}"><img class="avatar-tiny" src="/public/image/${data.avatar}"></a>
  //       <div class="chat-message">
  //         <div class="chat-message-inner">
  //           <a href="/profile/${data.username}"><strong>${data.username}:</strong></a>
  //           ${sanitizedMessage}
  //         </div>
  //       </div>
  //     </div>
  //   `)
  // );

  // Scroll to the bottom of the chat log
  this.chatLog.scrollTop = this.chatLog.scrollHeight;
}


  injectHTML() {
    this.chatWrapper.classList.add("chat-wrapper--ready")
    this.chatWrapper.innerHTML = `
    <div class="chat-title-bar">Chat <span class="chat-title-bar-close"><i class="fas fa-times-circle"></i></span></div>
    <div id="chat" class="chat-log"></div>
    
    <form id="chatForm" class="chat-form border-top">
      <input type="text" class="chat-field" id="chatField" placeholder="Type a message…" autocomplete="off">
    </form>
    `
  }
}
