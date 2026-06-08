<!-- 💬 Floating Chat Button -->
<div id="chat-widget">
    <div id="chat-toggle">💬</div>

    <div id="chat-box">
        <div id="chat-header">
            <span>HotelNest Assistant </span>
            <button id="close-chat">✖</button>
        </div>
        <div id="chat-body"></div>
        <div id="chat-input-area">
            <input type="text" id="chat-message" placeholder="Type your message...">
            <button id="send-chat">Send</button>
        </div>
    </div>
</div>


<style>
#chat-widget {
    position: fixed;
    bottom: 30px;
    right: 30px;
    z-index: 9999;
}

#chat-toggle {
    background-color: #dc3545;
    color: white;
    width: 60px;
    height: 60px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 30px;
    cursor: pointer;
    box-shadow: 0 4px 10px rgba(0,0,0,0.3);
    transition: transform 0.2s;
}

#chat-toggle:hover {
    transform: scale(1.1);
}

#chat-box {
    display: none;
    flex-direction: column;
    width: 350px;
    height: 450px;
    background: white;
    border-radius: 10px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.3);
    overflow: hidden;
    position: fixed;
    bottom: 100px;
    right: 30px;
}

#chat-header {
    background: #dc3545;
    color: white;
    padding: 12px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-weight: bold;
    font-size: 16px;
}

#close-chat {
    background: transparent;
    border: none;
    color: white;
    font-size: 20px;
    cursor: pointer;
    padding: 0;
    width: 24px;
    height: 24px;
}

#close-chat:hover {
    opacity: 0.8;
}

#chat-body {
    flex: 1;
    padding: 15px;
    overflow-y: auto;
    font-size: 14px;
    background: #f9f9f9;
    line-height: 1.5;
}

.user { 
    color: #1c61a7; 
    margin: 10px 0;
    padding: 10px 12px;
    background: #e3f2fd;
    border-radius: 8px;
    border-left: 3px solid #1976d2;
}

.bot { 
    color: #2e7d32; 
    margin: 10px 0;
    padding: 10px 12px;
    background: #e8f5e9;
    border-radius: 8px;
    border-left: 3px solid #4caf50;
}

#chat-input-area {
    display: flex;
    padding: 12px;
    border-top: 1px solid #ddd;
    background: white;
    gap: 8px;
}

#chat-input-area input {
    flex: 1;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 6px;
    font-size: 14px;
}

#chat-input-area input:focus {
    outline: none;
    border-color: #dc3545;
}

#chat-input-area button {
    background: #dc3545;
    color: white;
    border: none;
    border-radius: 6px;
    padding: 10px 20px;
    cursor: pointer;
    font-weight: bold;
    transition: background 0.2s;
}

#chat-input-area button:hover {
    background: #c82333;
}

/* Scrollbar styling */
#chat-body::-webkit-scrollbar {
    width: 6px;
}

#chat-body::-webkit-scrollbar-track {
    background: #f1f1f1;
}

#chat-body::-webkit-scrollbar-thumb {
    background: #888;
    border-radius: 3px;
}

#chat-body::-webkit-scrollbar-thumb:hover {
    background: #555;
}
</style>


<script>
document.addEventListener('DOMContentLoaded', function() {
    
  
    document.getElementById('chat-toggle').addEventListener('click', function() {
        document.getElementById('chat-box').style.display = 'flex';
        document.getElementById('chat-toggle').style.display = 'none';
    });

    
    document.getElementById('close-chat').addEventListener('click', function() {
        document.getElementById('chat-box').style.display = 'none';
        document.getElementById('chat-toggle').style.display = 'flex';
    });

    // Send on button click
    document.getElementById('send-chat').addEventListener('click', sendMessage);
    
    // Send on Enter key
    document.getElementById('chat-message').addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            sendMessage();
        }
    });

    // Main send message function
    async function sendMessage() {
        const messageInput = document.getElementById('chat-message');
        const message = messageInput.value.trim();
        
        if (!message) return;

        const chatBody = document.getElementById('chat-body');
        
        // Show user message
        chatBody.innerHTML += `<div class='user'><b>You:</b> ${message}</div>`;
        messageInput.value = '';

        // Show typing indicator
        chatBody.innerHTML += `<div class='bot' id='typing'><i>Bot is typing...</i></div>`;
        chatBody.scrollTop = chatBody.scrollHeight;

        try {
            // Get CSRF token
            let csrfToken = document.querySelector('meta[name="csrf-token"]');
            
            if (!csrfToken) {
                console.error('CSRF token not found!');
                throw new Error('CSRF token missing');
            }
            
            csrfToken = csrfToken.getAttribute('content');
            
            // Send request
            const response = await fetch('/chat/send', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ message: message })
            });

            // Remove typing indicator
            const typingEl = document.getElementById('typing');
            if (typingEl) typingEl.remove();

            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }

            const data = await response.json();
            
            // Convert \n to <br> for proper line breaks
            const formattedReply = data.reply.replace(/\\n/g, '<br>');
            
            chatBody.innerHTML += `<div class='bot'><b>Bot:</b> ${formattedReply}</div>`;
            
        } catch (error) {
            // Remove typing indicator on error
            const typingEl = document.getElementById('typing');
            if (typingEl) typingEl.remove();
            
            console.error('Chat error:', error);
            chatBody.innerHTML += `<div class='bot'><b>Bot:</b> Sorry, something went wrong. Please try again.</div>`;
        }

        chatBody.scrollTop = chatBody.scrollHeight;
    }
});
</script>