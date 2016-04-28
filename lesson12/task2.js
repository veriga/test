function change_size (n)
{
    if (confirm('Ви точно бажаєте змінити розмір тексту?')) {
        document.getElementById('text').style.fontSize = n + 'px';
        document.getElementById('text').style.color = 'black';
    }
else {
        document.getElementById('text').style.fontSize = '2em';
        document.getElementById('text').style.color = 'red';
    }
}
