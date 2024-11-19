<form method="post" action="emitir_receta.php">
    <input type="hidden" name="paciente_id" value="<?php echo $paciente_id; ?>">
    <input type="hidden" name="doctor_id" value="<?php echo $doctor_id; ?>">
    <select name="medicamento_id[]" multiple required>
        <!-- Opciones de medicamentos desde la base de datos -->
    </select>
    <input type="number" name="cantidad[]" placeholder="Cantidad" required>
    <button type="submit">Emitir Receta</button>
</form>