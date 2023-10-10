<?php
class Template
{
    /**
     * 
     * Thư mục views.
     * 
     */
    private $__directory;

    /**
     * 
     * Layout của views.
     * Thuộc tính này sẽ có giá trị là view parent - view cần kế thừa của view đang được gọi. 
     * @default null
     * 
     */
    private $__layout;

    /**
     * 
     * Các section của layout. VD: content, sidebar, header, footer,... Nói chung ai dùng fw rồi đều sẽ biết
     * 
     */
    private $__sections;

    /**
     * 
     * section hiện tại đang xét.
     * @default null
     * 
     */
    private $__current_section;

    /**
     * 
     * Ham khoi tao
     * 
     */
    public function __construct($directory)
    {
        $this->__directory = $directory;
        $this->__layout = null;
        $this->__current_section = null;
    }


    /**
     * 
     * Hàm kiểm tra đường dẫn của file view
     * 
     * @param string $path Đường dẫn của file. Đuôi file sẽ là .php
     * 
     * @return string 
     * 
     */
    private function __resolvePath(string $path)
    {
        clearstatcache();
        $file =  __DIR__ .$this->__directory . '\\' . $path . '.php';
        if (!file_exists($file)) {
            throw new Exception("$file is not exist");
        }
        return $file;
    }

    /**
     * 
     * Include một view trong một view
     * 
     * @param string $view_name Tên view cần include (giống include file php trong php đó)
     * 
     * 
     */
    public function include(string $view_name)
    {
        ob_start();

        include_once $this->__resolvePath($view_name);

        $content = ob_get_contents();

        ob_end_clean();

        echo $content;
    }

    /**
     * 
     * Hàm bắt đầu một section
     * 
     * @param string $name Tên của section.
     * 
     */
    public function section(string $name)
    {
        $this->__current_section = $name;
        ob_start();
    }

    /**
     * 
     * Hàm kết thúc một section
     * 
     */
    public function end()
    {
        if (empty($this->__current_section)) {
            throw new Exception("There is not a section start");
        }

        $content = ob_get_contents();

        ob_end_clean();

        $this->__sections[$this->__current_section] = $content;

        $this->__current_section = null;
    }

    /**
     * 
     * Hàm kế thùa layout trong views
     * 
     * @param string $layout Layout cần kế thừa
     * 
     */
    public function layout(string $layout)
    {
        $this->__layout = $layout;
    }

    /**
     * 
     * Hàm xác định vị trí section sẽ được render trong file layout view
     * 
     * @param string $name Tên section cần render
     * 
     * 
     */
    public function renderSection(string $name)
    {
        echo $this->__sections[$name];
    }

    /**
     * 
     * Hàm load view
     * 
     * @param string $view_name Tên view cần load
     * @param array $args Các tham số cần truyền qua view
     * 
     * @return string
     * 
     */
    public function render(string $view_name, array $args)
    {
        if (is_array($args)) {
            extract($args);
        }

        ob_start();
        echo "<script>console.log('Debug Objects: " . $view_name . "' );</script>";
        include_once $this->__resolvePath($view_name);

        $content = ob_get_clean();

        if (empty($this->__layout)) {
            return $content;
        }

        if (ob_get_contents()) ob_clean();
        include_once $this->__resolvePath(strval($this->__layout));

        $output = ob_get_contents();

        if (ob_get_contents()) ob_end_clean();

        return $output;
    }
}
