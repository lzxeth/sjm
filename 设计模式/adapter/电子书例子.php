<?php

interface PaperBookInterface
{
    public function turnPage();

    public function open();
}


class Book implements PaperBookInterface
{
    public function open()
    {
        echo "打开纸书";
    }

    public function turnPage()
    {
        echo "纸书翻页";
    }
}


interface EBookInterface
{
    public function pressNext();

    public function pressStart();
}


class Kindle implements EBookInterface
{
    public function pressNext()
    {
        echo "按下一页";
    }

    public function pressStart()
    {
        echo "按开关启动";
    }
}

class EBookAdapter implements PaperBookInterface
{
    private $ebook;

    public function __construct(EBookInterface $kindle)
    {
        $this->ebook = $kindle;
    }

    public function open()
    {
        $this->ebook->pressStart();
    }

    public function turnPage()
    {
        $this->ebook->pressNext();
    }


}

$book = new Book();
$book->open();
$book->turnPage();

$kindle = new EBookAdapter(new Kindle());
$kindle->open();
$kindle->turnPage();

