from transformers import AutoTokenizer, AutoModelForMaskedLM
import torch
import sys

tokenizer = AutoTokenizer.from_pretrained("medicalai/ClinicalBERT")
model = AutoModelForMaskedLM.from_pretrained("medicalai/ClinicalBERT")

def ask_model(masked_sentence):
    if "[MASK]" not in masked_sentence:
        return "Please include [MASK] in your input sentence for prediction."

    inputs = tokenizer(masked_sentence, return_tensors="pt")
    with torch.no_grad():
        outputs = model(**inputs)
    logits = outputs.logits

    mask_token_index = (inputs["input_ids"] == tokenizer.mask_token_id).nonzero(as_tuple=True)[1]
    mask_logits = logits[0, mask_token_index, :]
    predicted_token_id = torch.argmax(mask_logits, dim=-1)
    predicted_token = tokenizer.decode(predicted_token_id)

    return masked_sentence.replace("[MASK]", predicted_token)

if __name__ == "__main__":
    question = sys.argv[1]
    print(ask_model(question))
