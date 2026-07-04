<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Inscrição Confirmada</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f4f4f4; padding: 20px; color: #333;">

    <div style="max-width: 600px; margin: 0 auto; background-color: #ffffff; padding: 30px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">

        <h2 style="color: #4A5568; text-align: center;">¡Inscrição Confirmada com Sucesso! 🎉</h2>

        <p>Olá, <strong>{{ $name }}</strong>,</p>

        <p>Seja muito bem-vindo! A inscrição da criança <strong>{{ $childname }}</strong> foi realizada com sucesso em nosso evento.</p>

        <div style="background-color: #EDF2F7; padding: 15px; border-radius: 5px; margin: 20px 0;">
            <p style="margin: 0; font-weight: bold; color: #2D3748; text-align: center;">
                ⚠️ INFORMAÇÃO IMPORTANTE PARA O DIA DO EVENTO:
            </p>
            <p style="margin: 5px 0 0 0; text-align: center; font-size: 14px;">
                Apresente o QR Code abaixo na recepção para realizar o credenciamento rápido e imprimir a etiqueta de identificação.
            </p>
        </div>

        <!-- Exibição do QR Code Gerado -->
        <div style="text-align: center; margin: 30px 0;">
            <img src="{{ $message->embed($qrCodePath) }}" alt="QR Code">
            <p style="font-size: 12px; color: #718096; margin-top: 5px;">Este é o código exclusivo do participante.</p>
        </div>

        <p style="text-align: center; font-size: 14px; color: #718096;">
            Se tiver alguma dúvida ou precisar alterar dados, entre em contato conosco respondendo a este e-mail.
        </p>

        <hr style="border: 0; border-top: 1px solid #E2E8F0; margin: 20px 0;">

        <p style="text-align: center; font-size: 12px; color: #A0AEC0; margin: 0;">
            Mensagem automática enviada pelo Sistema de Inscrições da Igreja.
        </p>
    </div>

</body>
</html>
