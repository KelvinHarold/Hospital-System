from transformers import AutoTokenizer, AutoModelForMaskedLM
import torch
import sys

tokenizer = AutoTokenizer.from_pretrained("medicalai/ClinicalBERT")
model = AutoModelForMaskedLM.from_pretrained("medicalai/ClinicalBERT")

def ask_model(question):
    inputs = tokenizer(question, return_tensors="pt")
    outputs = model(**inputs)
    logits = outputs.logits
    predicted_token_id = torch.argmax(logits, dim=-1)
    decoded = tokenizer.decode(predicted_token_id[0])
    return decoded

if __name__ == "__main__":
    question = sys.argv[1]
    print(ask_model(question))
