from gpt4all import GPT4All

# Khởi tạo mô hình
model_path = "/Applications/XAMPP/xamppfiles/htdocs/cnpm1/models/mistral-7b-instruct-v0.1.Q4_0.gguf"

def chat_with_ai(user_input):
    response = model.generate(user_input)
    return response

# Kiểm tra chatbot
if __name__ == "__main__":
    while True:
        user_input = input("Bạn: ")
        if user_input.lower() == "exit":
            break
        bot_response = chat_with_ai(user_input)
        print("AI:", bot_response)
