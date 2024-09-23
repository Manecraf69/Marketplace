<!-- Retirada de peças -->
<div class="coluna">
    <label for="pecas">Retirada de peças? <span style="color: red;">*</span></label>
    <select name="pecas" id="pecas" required>
        <option value="" disabled selected>Definir</option>
        <option value="Apenas completo">Apenas completo</option>
        <option value="Apenas peças">Apenas peças</option>
        <option value="Completo ou peças">Completo ou peças</option>
    </select>
</div>

<!-- Venda de rodas -->
<div class="coluna">
    <label for="rodas">Venda das rodas? <span style="color: red;">*</span></label>
    <select name="rodas" id="rodas" required>
        <option value="" disabled selected>Definir</option>
        <option value="completo">Apenas completo</option>
        <option value="rodas">Apenas rodas</option>
        <option value="completo_rodas">Completo ou rodas</option>
    </select>
</div>

<!-- Tipo -->
<div class="coluna">
    <label for="tipo_rodas">Tipo de rodas:</label>
    <select name="tipo_rodas" id="tipo_rodas">
        <option value="" disabled selected>Definir</option>
        <option value="Ferro / Calota">Ferro / Calota</option>
        <option value="Liga leve">Liga leve</option>
    </select>
</div>

<!-- Tamanho -->
<div class="coluna">
    <label for="tamanho_rodas">Tamanho do aro:</label>
    <input type="text" name="tamanho_rodas" id="tamanho_rodas" placeholder="Ex: 17''">
</div>