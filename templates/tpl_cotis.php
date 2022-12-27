<style>
    body {
        text-align: center;
    }

    table {
        border-collapse: collapse;
        width: 80%;
        margin: 0 auto;
        margin-top: 20px;

    }

    th {
        background-color: #31C6D4;
        color: white;
    }

    tr {
        border: 1px solid black;
        text-align: center;
        height: 30px;
    }

    .bad-result {
        background-color: #FF1E1E;
    }

    .good-result {
        background-color: #00FFD1;
    }

    .same-result {
        background-color: yellow;
    }

    tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    #recargar {
        margin-top: 120px;
        height: 30px;
        
        margin-left: auto;
        margin-right: auto;
    }
</style>

<body>
    <?php echo $table; ?>

</body>