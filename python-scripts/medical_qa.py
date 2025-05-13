import sys
from transformers import pipeline

question = sys.argv[1]

qa = pipeline("question-answering", model="deepset/roberta-base-squad2")
context = """
Diabetes is a chronic medical condition in which the body cannot properly regulate blood sugar levels. 
There are different types, including Type 1, Type 2, and gestational diabetes. 
Symptoms include frequent urination, increased thirst, and unexplained weight loss.
"""

result = qa(question=question, context=context)
print(result["answer"].strip())
