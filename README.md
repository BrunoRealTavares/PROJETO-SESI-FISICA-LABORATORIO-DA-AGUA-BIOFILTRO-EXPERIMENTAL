# Laboratório Digital de Qualidade da Água & Biofiltro Experimental (ODS 6)
> **Simulação de Testes Físico-Químicos e Eficiência de Filtragem**
> Aplicação web desenvolvida em PHP para simulação de um laboratório digital de testes de qualidade da água. O sistema é capaz de calcular e classificar parâmetros físico-químicos com base nos padrões oficiais de potabilidade, calcular a taxa de eficiência de remoção do biofiltro experimental e validar toda a lógica de negócio por meio de testes unitários automatizados com **PHPUnit**.
> 
> Este projeto está alinhado ao **Objetivo de Desenvolvimento Sustentável 6 (Água Potável e Saneamento)** da ONU e às normas da **Portaria GM/MS nº 888/2021** do Ministério da Saúde.

---

## Desenvolvedores & Contribuições

* **Bruno Tavares** (`bruno.tavares@ba.estudante.senai.br`)
  * Estrutura base da arquitetura MVC.
  * Modelos de negócio e entidades (`App\Model\Indicadores`, `App\Model\Biofiltro` e `App\Model\AmostraAgua`).
  * Regras de validação de parâmetros e exceções de borda.

* **Pedro Lucas** (`pedrolucaspaz359@gmail.com`)
  * Controladores e fluxo de rotas da aplicação.
  * Interface web responsiva em Bootstrap 5.
  * Suíte de testes unitários automatizados com PHPUnit 11.

---

## Tecnologias Utilizadas

* **Linguagem:** PHP >= 8.4
* **Interface Web:** HTML5, CSS3, Bootstrap 5
* **Gerenciamento de Dependências:** Composer (Mapeamento PSR-4)
* **Testes Automatizados:** PHPUnit 11
* **Ambiente de Execução:** XAMPP / Apache / PHP CLI

---

## Algoritmos Implementados

O sistema conta com algoritmos especializados localizados no namespace `App\Model`:

1. **Classificação de Parâmetros de Potabilidade (`App\Model\Indicadores`)**:
   * **pH (`classificarPh`)**: Avalia a faixa ideal de potabilidade ($6,0 \le \text{pH} \le 9,5$). Classifica amostras abaixo de 6,0 como *Ácido (Inadequado)* e acima de 9,5 como *Alcalino (Inadequado)*.
   * **Turbidez (`classificarTurbidez`)**: Avalia o limite máximo permitido ($\le 5,0\text{ UNT}$). Classifica valores superiores como *Elevada (Inadequado)*.
   * **Cloro Residual (`classificarCloro`)**: Avalia a faixa de desinfecção ($0,2 \le \text{Cloro} \le 5,0\text{ mg/L}$). Classifica valores $< 0,2$ como *Insuficiente* e $> 5,0$ como *Excessivo*.
   * **Parecer Final (`analisarAmostraCompleta`)**: Integra as classificações individuais e gera o diagnóstico global da amostra (*Água Potável* ou *Água Não Potável*).

2. **Cálculo de Eficiência do Biofiltro (`App\Model\Biofiltro`)**:
   * **Taxa de Remoção de Turbidez (`calcularEficiencia`)**: Aplica a fórmula percentual de redução de turbidez pré e pós-filtragem:
     $$\text{Eficiência (\%)} = \left( \frac{\text{Turbidez}_{\text{bruta}} - \text{Turbidez}_{\text{filtrada}}}{\text{Turbidez}_{\text{bruta}}} \right) \times 100$$
   * Contém tratamento de exceções para divisões por zero e valores fisicamente impossíveis (turbidez negativa).

3. **Entidade de Validação (`App\Model\AmostraAgua`)**:
   * Encapsula os dados físico-químicos da água (pH, turbidez, cloro, condutividade e temperatura) aplicando validações de borda na instanciação.

