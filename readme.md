<p align="center">
<img src=https://user-images.githubusercontent.com/9040771/185430152-639d5c14-4ec2-4e28-882c-2837613775ab.png />
</p>

# Plataforma SAM
 Plataforma Web gamificada para ensino voltado a crianças com deficiência de aprendizagem. Desenvolvimento baseado em [Laravel (5.2)](https://laravel.com/docs/5.2/installation).

 Esse projeto foi realizado como Projeto de Conclusão de Curso no curso de Bacharelado em Sistemas de Informação, na Universidade Federal Rural de Pernambuco.
 
 A monografia completa pode ser encontrada [aqui](https://github.com/victoic/Plataforma-SAM/blob/main/TCC/TCC-AVAL.pdf).
 
 ## Requisitos
 Para rodar a Plataforma SAM localmente é necessário:
 - PHP entre as versões 5.5.9 - 7.1.*;
 - MySQL
 - [Composer](http://getcomposer.org/)
 - Laravel 5.2 (Instruções para instalação disponíveis [aqui](https://laravel.com/docs/5.2/installation))
 
 EasyPHP é uma ferramenta de desenvolvimento de fácil uso que traz boa parte dos softwares necessários, a [versão 17](https://bitbucket.org/easyphp/easyphp-devserver/downloads/EasyPHP-Devserver-17.0-setup.exe) possui a versão de PHP compatível.
 
 ### Inicindo a Plataforma SAM
 Renomeie o arquivo ".envexample" para ".env".
 
 Após possuir seu servidor local devemos criar um usuário e um Banco de Dados no MySQL com ambos com nome "sam", caso uma senha seja definida é necessário definir a senha no arquivo ".env", no campo `DB_PASSWORD`.
 
 Com o Composer instalado rode:
 
 `composer global require "laravel/installer"`
 
 Com o Laravel instalado, basta ir até o local desse repositório:
 
 `cd "path/to/Plataforma-SAM"`
 
 E executar a migração para criar as tabelas do Banco de Dados:
 
 `php artisan migrate`
 
 Gere uma nova chave para o aplicato com:
 
 `php artisan key:generate`
 
 E adicione a chave no ".env", no campo `APP_KEY`.

 ## Citação
 @inproceedings{lundgren2017plataforma,
  title={Plataforma SAM: a gamifica{\c{c}}{\~a}o e a colabora{\c{c}}{\~a}o em uma plataforma de aprendizagem para o ensino da matem{\'a}tica em crian{\c{c}}as portadoras de S{\'\i}ndrome de Down},
  author={Lundgren, Antonio and Felix, Zildomar},
  booktitle={Brazilian Symposium on Computers in Education (Simp{\'o}sio Brasileiro de Inform{\'a}tica na Educa{\c{c}}{\~a}o-SBIE)},
  volume={28},
  number={1},
  pages={625},
  year={2017}
}
