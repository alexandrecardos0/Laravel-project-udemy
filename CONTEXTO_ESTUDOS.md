# Contexto dos Estudos - Laravel

**Última atualização:** 10/03/2026
**Sessões de estudo:**
1. ✅ CRUD de Posts (04/03/2026)
2. 🔄 API de Pagamentos (10/03/2026) - EM ANDAMENTO

---

## 📊 Status do Projeto

---

# SESSÃO 1: CRUD de Posts (04/03/2026)

### O que já está funcionando (100%)

#### 1. CREATE - Criar Posts
- **Controller:** `PostController@create` e `PostController@store` - ✅ COMPLETO
- **View:** `resources/views/posts/create.blade.php` - ✅ COMPLETO
- **Validação:** Implementada com regras corretas
- **Redirect:** Volta para `posts.index` com mensagem de sucesso

#### 2. READ - Listar e Visualizar Posts
- **Controller:** `PostController@index` e `PostController@show` - ✅ COMPLETO
- **Views:**
  - `resources/views/posts/index.blade.php` - ✅ COMPLETO
  - `resources/views/posts/show.blade.php` - ✅ COMPLETO

#### 3. UPDATE - Editar Posts
- **Controller:** `PostController@edit` - ✅ COMPLETO
- **View:** `resources/views/posts/edit.blade.php` - ✅ COMPLETO
- **Controller:** `PostController@update` - ⚠️ QUASE PRONTO (2 erros pequenos)

#### 4. DELETE - Deletar Posts
- **Controller:** `PostController@destroy` - ❌ NÃO IMPLEMENTADO (vazio)

---

## Erros que AINDA precisam ser corrigidos

### Arquivo: `app/Http/Controllers/PostController.php`

#### Erro 1 - Linha 77:
```php
// ERRADO:
$post = Post::update($validated);

// CORRETO:
$post->update($validated);
```

**Explicação:**
- `Post::update()` é um método estático que tenta atualizar TODOS os posts
- `$post->update()` atualiza apenas o post específico que você recebeu como parâmetro
- Não precisa atribuir a `$post` de novo, pois você já tem o objeto

---

#### Erro 2 - Linha 79:
```php
// ERRADO:
return redirect()->route('posts.edit')
    ->with('success', 'Post atualizado');

// OPÇÃO 1 - Redirecionar para a lista:
return redirect()->route('posts.index')
    ->with('success', 'Post atualizado');

// OPÇÃO 2 - Redirecionar para visualizar o post editado:
return redirect()->route('posts.show', $post)
    ->with('success', 'Post atualizado');
```

**Explicação:**
- `posts.edit` precisa de um parâmetro e não faz sentido voltar pro formulário
- Normalmente redireciona para `posts.index` (lista) ou `posts.show` (visualização)
- Se escolher `posts.show`, precisa passar o `$post` como segundo parâmetro

---

## Como ficaria o método update() correto:

```php
public function update(Request $request, Post $post)
{
    $validated = $request->validate([
        'title' => 'required|string|min:5|max:255',
        'body' => 'required|string|min:10',
    ]);

    $post->update($validated);

    // Escolha UMA das opções:

    // Opção 1: Voltar para lista
    return redirect()->route('posts.index')
        ->with('success', 'Post atualizado');

    // OU

    // Opção 2: Mostrar o post editado
    return redirect()->route('posts.show', $post)
        ->with('success', 'Post atualizado');
}
```

---

## Próximos passos sugeridos:

1. ✅ Corrigir os 2 erros do método `update()`
2. ✅ Testar a funcionalidade de editar posts
3. ⬜ Implementar o método `destroy()` para deletar posts
4. ⬜ Adicionar botões de "Editar" e "Deletar" nas views (index.blade.php ou show.blade.php)
5. ⬜ Adicionar confirmação antes de deletar (JavaScript ou Laravel)

---

## Conceitos importantes aprendidos:

### 1. Route Model Binding
Quando você coloca `Post $post` no método do controller, o Laravel automaticamente busca o post pelo ID da URL. Não precisa fazer `Post::findOrFail($id)` manualmente!

```php
// Laravel faz isso automaticamente:
public function edit(Post $post) {
    // $post já vem carregado do banco!
}
```

### 2. Métodos estáticos vs Métodos de instância
- `Post::create()` = método **estático** da classe (cria novo registro)
- `$post->update()` = método da **instância** (atualiza registro existente)

### 3. Validação
Sempre validar os dados antes de salvar no banco:
```php
$validated = $request->validate([
    'title' => 'required|string|min:5|max:255',
    'body' => 'required|string|min:10',
]);
```

### 4. Rotas Resource
`Route::resource('posts', PostController::class)` cria 7 rotas automaticamente:
- GET /posts → index
- GET /posts/create → create
- POST /posts → store
- GET /posts/{post} → show
- GET /posts/{post}/edit → edit
- PUT/PATCH /posts/{post} → update
- DELETE /posts/{post} → destroy

---

## Arquivos modificados na sessão:

1. `resources/views/posts/edit.blade.php` - Criado e corrigido
2. `app/Http/Controllers/PostController.php` - Métodos `edit()` e `update()` trabalhados

---

## Status final da sessão:

O aluno está aprendendo **na prática** e corrigindo os próprios erros (excelente abordagem!).

**CRUD Status:**
- ✅ CREATE - 100%
- ✅ READ - 100%
- ⚠️ UPDATE - 95% (faltam 2 pequenas correções)
- ❌ DELETE - 0%

**Próxima sessão:** Corrigir os 2 erros do `update()` e partir para o `destroy()`!

---

**Boa sorte com os estudos! Você está indo muito bem! 🚀**

---
---

# SESSÃO 2: API de Pagamentos (10/03/2026)

**Objetivo:** Aprender a criar uma API REST simples para gateway de pagamento fake (estudos para prova)

---

## 📋 Passos Implementados

### ✅ PASSO 1: Criar Model + Migration
**Comando:**
```bash
php artisan make:model Payment -m
```
**Resultado:**
- `app/Models/Payment.php` criado
- `database/migrations/xxxx_create_payments_table.php` criado

---

### ✅ PASSO 2: Configurar Migration (estrutura da tabela)
**Arquivo:** `database/migrations/xxxx_create_payments_table.php`

**Campos criados:**
```php
$table->id();
$table->string('transaction_id')->unique();
$table->integer('amount');
$table->enum('status', ['pending', 'approved', 'failed']);
$table->timestamps();
```

**Conceitos aprendidos:**
- `string()` = texto (VARCHAR)
- `integer()` = número inteiro
- `enum()` = valores limitados
- `->unique()` = não pode repetir
- `timestamps()` = cria created_at e updated_at

---

### ✅ PASSO 3: Configurar Model (fillable)
**Arquivo:** `app/Models/Payment.php`

```php
protected $fillable = [
    'transaction_id',
    'amount',
    'status',
];
```

**Conceito:** Mass Assignment Protection
- Lista os campos que PODEM ser preenchidos
- Proteção de segurança do Laravel

---

### ✅ PASSO 4: Rodar Migration
**Comando:**
```bash
php artisan migrate
```
**Resultado:** Tabela `payments` criada no banco de dados

---

### ✅ PASSO 5: Criar Controller
**Comando:**
```bash
php artisan make:controller PaymentController --api
```
**Métodos criados:**
- `index()` - listar todos
- `store()` - criar novo
- `show()` - ver um específico
- `update()` - atualizar
- `destroy()` - deletar

---

### ✅ PASSO 6: Criar Rotas da API
**Arquivo:** `routes/api.php`

```php
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;

Route::apiResource('payments', PaymentController::class);
```

**Rotas criadas automaticamente:**
- `POST /api/payments` → store
- `GET /api/payments` → index
- `GET /api/payments/{id}` → show
- `PUT /api/payments/{id}` → update
- `DELETE /api/payments/{id}` → destroy

---

### ✅ PASSO 7: Implementar Validação no store()
**Arquivo:** `app/Http/Controllers/PaymentController.php`

```php
$validated = $request->validate([
    "amount" => 'required|integer|min:1',
    "status" => 'in:pending,approved,failed',
]);
```

**Regras usadas:**
- `required` = obrigatório
- `integer` = número inteiro
- `min:1` = valor mínimo
- `in:valor1,valor2` = só aceita valores específicos

---

### 🔄 PASSO 8: Gerar transaction_id único (EM ANDAMENTO)
**Opções:**
```php
// Laravel (recomendado)
use Illuminate\Support\Str;
$validated['transaction_id'] = 'txn_' . Str::uuid();

// PHP nativo
$validated['transaction_id'] = 'txn_' . uniqid();
```

---

## 📚 Links da Documentação Usados

1. **Eloquent (Models):** https://laravel.com/docs/11.x/eloquent
2. **Migrations:** https://laravel.com/docs/11.x/migrations
3. **Column Types:** https://laravel.com/docs/11.x/migrations#available-column-types
4. **Mass Assignment:** https://laravel.com/docs/11.x/eloquent#mass-assignment
5. **Controllers:** https://laravel.com/docs/11.x/controllers
6. **API Resources:** https://laravel.com/docs/11.x/controllers#api-resource-controllers
7. **Routing:** https://laravel.com/docs/11.x/routing
8. **Validation:** https://laravel.com/docs/11.x/validation
9. **Str::uuid():** https://laravel.com/docs/11.x/strings#method-str-uuid

---

## 🎯 Próximos Passos

- ⬜ Finalizar método `store()` (salvar no banco + retornar JSON)
- ⬜ Testar criação de pagamento no Postman
- ⬜ Implementar método `index()` (listar pagamentos)
- ⬜ Implementar método `show()` (ver um pagamento)
- ⬜ Testar todos os endpoints no Postman

---

## 💡 Conceitos Importantes Aprendidos

### 1. API REST
- Usa JSON para comunicação
- Métodos HTTP: GET, POST, PUT, DELETE
- Status codes: 200 (OK), 201 (Created), 422 (Validation Error)

### 2. Route Resource
Uma única linha cria múltiplas rotas automaticamente:
```php
Route::apiResource('payments', PaymentController::class);
```

### 3. Validação
Laravel valida automaticamente e retorna erro se falhar:
```php
$validated = $request->validate([...]);
```

### 4. Tipos de Dados na Migration
- Texto = `string()` ou `text()`
- Número = `integer()` ou `decimal()`
- Opções limitadas = `enum()`
- Data = `date()` ou `datetime()`

---

**Sessão continua... 🚀**
