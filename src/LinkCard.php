<?php

class LinkCard
{
    private string $url;
    private string $keyword;
    private string $title;
    private string $description;
    private string $styleClass;

    public function __construct(
        string $url = 'https://cnwebs-circle28.com',
        string $keyword = '28圈',
        string $title = '28圈 - 在线娱乐平台',
        string $description = '探索无限可能的数字世界，28圈为您提供丰富的互动体验。',
        string $styleClass = 'link-card-default'
    ) {
        $this->url = $url;
        $this->keyword = $keyword;
        $this->title = $title;
        $this->description = $description;
        $this->styleClass = $styleClass;
    }

    public function setUrl(string $url): void
    {
        $this->url = $url;
    }

    public function setKeyword(string $keyword): void
    {
        $this->keyword = $keyword;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function setStyleClass(string $styleClass): void
    {
        $this->styleClass = $styleClass;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getKeyword(): string
    {
        return $this->keyword;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getStyleClass(): string
    {
        return $this->styleClass;
    }

    public function render(): string
    {
        $escapedUrl = htmlspecialchars($this->url, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $escapedKeyword = htmlspecialchars($this->keyword, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $escapedTitle = htmlspecialchars($this->title, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $escapedDescription = htmlspecialchars($this->description, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $escapedClass = htmlspecialchars($this->styleClass, ENT_QUOTES | ENT_HTML5, 'UTF-8');

        $html = '<div class="' . $escapedClass . '">' . "\n";
        $html .= '    <a href="' . $escapedUrl . '" target="_blank" rel="noopener noreferrer">' . "\n";
        $html .= '        <div class="link-card-content">' . "\n";
        $html .= '            <span class="link-card-keyword">' . $escapedKeyword . '</span>' . "\n";
        $html .= '            <h3 class="link-card-title">' . $escapedTitle . '</h3>' . "\n";
        $html .= '            <p class="link-card-description">' . $escapedDescription . '</p>' . "\n";
        $html .= '        </div>' . "\n";
        $html .= '    </a>' . "\n";
        $html .= '</div>';

        return $html;
    }

    public static function fromArray(array $config): self
    {
        $card = new self();
        if (isset($config['url'])) {
            $card->setUrl($config['url']);
        }
        if (isset($config['keyword'])) {
            $card->setKeyword($config['keyword']);
        }
        if (isset($config['title'])) {
            $card->setTitle($config['title']);
        }
        if (isset($config['description'])) {
            $card->setDescription($config['description']);
        }
        if (isset($config['styleClass'])) {
            $card->setStyleClass($config['styleClass']);
        }
        return $card;
    }

    public static function renderMultiple(array $cards): string
    {
        $output = '';
        foreach ($cards as $cardConfig) {
            if ($cardConfig instanceof self) {
                $output .= $cardConfig->render() . "\n";
            } elseif (is_array($cardConfig)) {
                $card = self::fromArray($cardConfig);
                $output .= $card->render() . "\n";
            }
        }
        return $output;
    }
}

function render_link_card(
    string $url = 'https://cnwebs-circle28.com',
    string $keyword = '28圈',
    string $title = '',
    string $description = '',
    string $styleClass = 'link-card-default'
): string {
    $card = new LinkCard($url, $keyword, $title ?: '28圈 - 在线娱乐平台', $description ?: '探索无限可能的数字世界，28圈为您提供丰富的互动体验。', $styleClass);
    return $card->render();
}

$sampleCard = new LinkCard();
echo $sampleCard->render();