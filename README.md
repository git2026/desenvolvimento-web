# Projeto de Inteligência Artificial

Sistema de detecção de fake news que utiliza algoritmos de machine learning para classificar notícias em verdadeiras ou falsas, permitindo análise de texto e avaliação de diferentes modelos de classificação.

## 1. Ferramentas e Tecnologias Utilizadas

No projeto, foram utilizadas as seguintes tecnologias e recursos:

**Linguagem de Programação:** Python para desenvolvimento do algoritmo de machine learning
**Bibliotecas de Machine Learning:** scikit-learn para implementação dos algoritmos de classificação
**Algoritmos Utilizados:** Regressão Logística, SVM (Support Vector Machine), Naive Bayes e Floresta Aleatória
**Processamento de Dados:** Biblioteca datasets para carregamento e manipulação do dataset
**Visualização:** matplotlib para criação de gráficos e análise de resultados
**Dataset:** [ErfanMoosaviMonazzah/fake-news-detection-dataset-English](https://huggingface.co/datasets/ErfanMoosaviMonazzah/fake-news-detection-dataset-English) do Hugging Face

## 2. Requisitos para Execução do Projeto

Instale as dependências necessárias:
```bash
pip install datasets scikit-learn matplotlib
```

Execute o código principal:
```bash
python Codigo_AI.py
```

**Nota:** O código foi desenvolvido para execução no Google Colab, contendo comandos específicos para essa plataforma.

## Estrutura do Projeto

```
inteligencia-artificial/
├── Codigo_AI.py              # Script principal com algoritmos de ML
├── dataset/                  # Conjunto de dados para treino e teste
│   ├── train.tsv            # Dados de treino
│   ├── test.tsv             # Dados de teste
│   └── validation.tsv       # Dados de validação
├── docs/                    # Documentação do projeto
│   ├── Proposta AI.docx     # Proposta inicial do projeto
│   ├── Relatório de AI.docx # Relatório final
│   └── Video_AI.mkv         # Vídeo demonstrativo
└── README.md               # Este ficheiro
```

## Licença

GNU v3.0
