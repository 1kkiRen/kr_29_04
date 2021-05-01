<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <!-- Подключаем Bootstrap, чтобы не работать над дизайном проекта -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
    <div id="app">
        <div class="container mt-5">
            <h1>Список книг нашей библиотеки</h1>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Название</th>
                        <th scope="col">Автор</th>
                        <th scope="col">Наличие</th>
                        <th scope="col">Действия</th>
                    </tr>
                </thead>
                <tbody>
                    @verbatim
                    <tr v-for="item in items">
                        
                        <th scope="row">{{ item.id }}</th>
                        <td>{{ item.title }}</td>
                        <td>{{ item.author }}</td>
                        <td>
                            <button type="button" class="btn btn-outline-primary" v-on:click="changeBookAvailability(item.id)">
                                {{ item.availability }}
                            </button>
                        </td>
                        
                        <td>
                            <button type="button" class="btn btn-outline-danger" v-on:click="deleteBook(item.id)">
                                Удалить
                            </button>
                        </td>
                    </tr>
                    @endverbatim
                    <!-- Строка с полями для добавления новой книги -->
                    <tr>
                        <th scope="row">Добавить</th>
                        <td><input type="text" class="form-control" placeholder="Название книги" v-model="title"></td>
                        <td><input type="text" class="form-control" placeholder="Автор" v-model="author"></td>
                        <td></td>
                        <td>
                            <button type="button" class="btn btn-outline-success" v-on:click="addBook()">
                                Добавить
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!--Подключаем axios для выполнения запросов к api -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.18.0/axios.min.js"></script>

    <!--Подключаем Vue.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.6.10/vue.min.js"></script>

    <script>
        let vm = new Vue({
            el: '#app',
            data: {
                title: '',
                author: '',
                availability: 'Доступна',
                items: []
            },
            methods: {
                loadBookList(){
                    axios.get('api/book/all')
                    .then(req => {   
                        this.items = req.data ;                    
                        console.log(req.data);
                    })
                },
                addBook(){

                    console.log(this.title, this.author, this.availabilty);
                    axios.post('api/book/add', {
                        "title": this.title,
                        "author": this.author,
                        "availability": this.availability,
                        
                    })
                    .then((response) => {
                        console.log(response);
                        this.loadBookList();
                    });

                    
                },
                deleteBook(id){
                    axios.delete('api/book/delete/'+ id, {                   
                    })
                    .then(req => {
                        console.log(req.data);
                        this.loadBookList();
                    })
                },
                changeBookAvailability(id){
                    console.log(id);
                    axios.get('api/book/change_availability/'+ id, {          
                    })
                    .then(req => {
                        this.loadBookList();
                    })
                }
            },
            mounted(){
                // Сразу после загрузки страницы подгружаем список книг и отображаем его
                this.loadBookList();
            }
        });
    </script>
</body>
</html>