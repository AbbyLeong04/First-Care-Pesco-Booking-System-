// Chatbot Questions and Answers Definition
const chatFlow = {
    initial: {
        question: "Hello Dear User! >< How can I help you?",
        answers: {
            "bookingDetail": "How can I make a booking?",
            "paymentDetail": "I want to know about the payment details.",
            "profileDetail": "I want to edit or delete my account.",
            "accountDetail": "Forgot password problem solving.",
        },
    },
    bookingDetail: {
        question: "You can follow the step below to make a booking: \n\n1. Click the -Make a booking- button that show on your home page, booking page or payment page. \n\n2. Fill up the booking form and submit \n\n3. View the booking details at booking page \n\n4. Once the booking status became [confirmed], do your payment at the payment page \n\n5. Once the booking status became [completed] mean booking success, and wait for the admin call for services",
        answers: {
            "paymentWay": "How can I do the payment?",
            "availability":"How to check the service is available or not?",
            "edit":"How can I edit my booking details?",
            "initial": "Back",
        },
        responses: {
            "paymentWay": "Follow the step below to do you payment: \n\n1. Once your booking is confirmed, the price will show on the payment table \n\n2. Do you payment transfer to the bank account that show on the card [Do your payment] in the user dashboard or with the QR image that will show up when you click the -DuitNow- button \n\n3. Screenshot the payment resit and upload in the button that show on the payment table \n\n4. Wait for the admin to approve the payment, it usually take 1-2days",
            "availability": "Follow the step below to check the service availability: \n\n1. There will have a service availability check in the home page, fill up the form \n\n2. And you can check the service that you want is available or not (Every Sunday is Holiday, no service available)",
            "edit":"Follow the step below to edit or delete your booking: \n\n1. Click the booking page \n\n2. At the -Editing- column had 2 button, one is edit one is delete \n\n3. Once the booking is confirmed by admin, the booking is not allowed to edit, but you can delete it and make a new booking \n\n4. Only when the booking status is -pending-, user are allow to edit the booking details",
        },
    },
    paymentDetail: {
        question: "Follow the step below to do you payment: \n\n1. Once your booking is confirmed, the price will show on the payment table \n\n2. Do you payment transfer to the bank account that show on the card [Do your payment] in the user dashboard or with the QR image that will show up when you click the -DuitNow- button \n\n3. Screenshot the payment resit and upload in the button that show on the payment table \n\n4. Wait for the admin to approve the payment, it usually take 1-2days",
        answers: {
            "initial": "Back",
        },
    
    },
    profileDetail: {
        question: "Follow the step below to edit or delete your account: \n\n1. Click the setting button at the side menu, it will pop up the account setting \n\n2. Click the edit button to edit your information and the delete button is for delete your user account \n\nReminder: Your account cannot be recover once you click the delete button!!!",
        answers: {
            "initial": "Back",
        },
    },
    accountDetail: {
        question: "Dear user here are the important reminder for you: \n\n1.Click the verification button at side menu \n\n2.Fill up the form and remember the information, the information can be updated all the time \n\n3.It could be useful when you forgot your password!",
        answers: {
            "initial": "Back",
        },
    },
};

let currentState = "initial";

// Toggle Chatbot Window
function toggleChat() {
    const chatbotWindow = document.getElementById("chatbot-window");
    chatbotWindow.style.display = chatbotWindow.style.display === "flex" ? "none" : "flex";

    if (chatbotWindow.style.display === "flex") {
        initChatbot();
    }
}

// Initialize Chatbot
function initChatbot() {
    currentState = "initial";
    const messages = document.getElementById("messages");
    messages.innerHTML = ""; // Clear previous messages
    addBotMessage(chatFlow[currentState].question);
    displayAnswerButtons(chatFlow[currentState].answers);
}

// Add Bot Message
function addBotMessage(text) {
    const messages = document.getElementById("messages");
    const botMessageDiv = document.createElement("div");
    botMessageDiv.className = "bot-message";
    // 支持换行显示
    botMessageDiv.innerHTML = text.replace(/\n/g, "<br>");
    messages.appendChild(botMessageDiv);
    messages.scrollTop = messages.scrollHeight;
}

// Display Answer Buttons (禁用或隐藏旧按钮)
function displayAnswerButtons(answers) {
    const messages = document.getElementById("messages");

    // 清除旧按钮（上一个问题的按钮容器）
    const oldButtonsDiv = document.querySelector(".buttons-container");
    if (oldButtonsDiv) {
        oldButtonsDiv.remove();
    }

    // 创建新的按钮容器
    const buttonsDiv = document.createElement("div");
    buttonsDiv.className = "buttons-container";

    for (const [key, value] of Object.entries(answers)) {
        const button = document.createElement("button");
        button.textContent = value;
        button.className = "answer-button";

        // 点击后禁用按钮，防止重复点击
        button.onclick = () => {
            handleAnswerClick(key);
            // 禁用当前按钮点击
            button.disabled = true;
            button.classList.add("disabled-button");
        };

        buttonsDiv.appendChild(button);
    }

    messages.appendChild(buttonsDiv);
    messages.scrollTop = messages.scrollHeight;
}

// Handle Button Click (回答问题后清理旧按钮)
function handleAnswerClick(answerKey) {
    const state = chatFlow[currentState];
    const nextState = state.responses?.[answerKey] ? null : answerKey;

    // 更新状态并显示新的问题或答案
    if (nextState) {
        currentState = nextState;
        addBotMessage(chatFlow[currentState].question);
        displayAnswerButtons(chatFlow[currentState].answers);
    } else {
        addBotMessage(state.responses[answerKey]);
    }
}