from flask import Flask, request, jsonify
from gpt4all import GPT4All

app = Flask(__name__)

# Đường dẫn model (kiểm tra đúng tên file)
model_path = "/Applications/XAMPP/xamppfiles/htdocs/cnpm1/models/mistral-7b-instruct-v0.1.Q4_0.gguf"

try:
    model = GPT4All(model_path)
except FileNotFoundError:
    raise FileNotFoundError(f"Không tìm thấy model tại: {model_path}")

@app.route("/")
def home():
    return "API is running! Use /chat to interact."

@app.route("/chat", methods=["POST"])
def chat():
    data = request.get_json()
    user_message = data.get("message", "")

    if not user_message:
        return jsonify({"reply": "Bạn chưa nhập câu hỏi!"})

    response = model.generate(user_message)
    return jsonify({"reply": response})

if __name__ == "__main__":
    app.run(host="0.0.0.0", port=5050, debug=True)
