// const client = document.getElementById('clientss');
// if(client){
//     client.addEventListener('click', e => {
//          if(e.target.className === 'btn btn-danger delete-article' ){
//             if(confirm('Are you sure ? ')){
//                 const id = e.target.getAttribute('data-id');
//                 fetch('/Client/enregistrer/${id}',{
//                     method: 'DELETE'
//                 }).then( res =>window.location.reload());
//             }
//          }
        
//     });
// }
$('#ajout').click(e=>{
    e.preventDefault()
    $('#formajout').slideDown();
    $('#ajout').slideUp();

});
$('#annul').click(e=>{
    e.preventDefault()
    $('#formajout').slideUp();
    $('#ajout').slideDown();

});
