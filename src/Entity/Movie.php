<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\SerializedName;

/**
 * @ApiResource
 * @ApiFilter(SearchFilter::class, properties={"title": "partial", "duration": "exact"})
 * @ORM\Table(name="movie")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class Movie
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @Groups({"read"})
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=false)
     * @Groups({"read", "write"})
     */
    private $title;

    /**
     * @var int
     *
     * @ORM\Column(name="duration", type="integer", nullable=false)
     * @Groups({"read", "write"})
     */
    private $duration;

    /**
     * @var string|null
     *
     * @ORM\Column(name="poster_url", type="string", length=255, nullable=true)
     * @Groups({"read"})
     * @SerializedName("posterUrl")
     */
    private $posterUrl;

    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function updatePosterUrl(LifecycleEventArgs $args)
    {
        $title = $this->getTitle();
        $posterUrl = $this->fetchPosterUrl($title);
        $this->setPosterUrl($posterUrl);
    }

    private function fetchPosterUrl($movieTitle)
    {
        $apiKey = '81c28ccd5emsh80754595d3c7f1fp12278ejsn7d0f9e9ece57';
    
        $query = http_build_query([
            'q' => $movieTitle,
            'limit' => 1,
        ]);
    
        $url = 'https://imdb8.p.rapidapi.com/title/find?' . $query;
    
        $headers = [
            'X-RapidAPI-Key: ' . $apiKey,
        ];
    
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
        $response = curl_exec($ch);
        curl_close($ch);
    
        $data = json_decode($response, true);
    
        if (isset($data['results'][0]['image']['url'])) {
            return $data['results'][0]['image']['url'];
        }
    
        return null;
    }
    
    /**
     * Getter et setter pour les propriétés
     */

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDuration(): ?int
    {
        return $this->duration;
    }

    public function setDuration(int $duration): self
    {
        $this->duration = $duration;

        return $this;
    }

    public function getPosterUrl(): ?string
    {
        if (!$this->posterUrl) {
            $this->posterUrl = $this->fetchPosterUrl($this->getTitle());
        }

        return $this->posterUrl;
    }

    public function setPosterUrl(?string $posterUrl): self
    {
        if (!$posterUrl) {
            $posterUrl = $this->fetchPosterUrl($this->getTitle());
        }

        $this->posterUrl = $posterUrl;

        return $this;
    }
}
