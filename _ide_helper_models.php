<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\Author
 *
 * @property int $id
 * @property string $a_id
 * @property string $name
 * @property bool|null $eastern_order
 * @property string|null $personal_name
 * @property string|null $enumeration
 * @property string|null $title
 * @property mixed|null $alternate_names
 * @property mixed|null $uris
 * @property string|null $bio
 * @property string|null $location
 * @property string|null $birth_date
 * @property string|null $death_date
 * @property string|null $date
 * @property string|null $wikipedia
 * @property mixed|null $links
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Work[] $works
 * @property-read int|null $works_count
 * @method static \Database\Factories\AuthorFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Author newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Author newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Author query()
 * @method static \Illuminate\Database\Eloquent\Builder|Author whereAId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Author whereAlternateNames($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Author whereBio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Author whereBirthDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Author whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Author whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Author whereDeathDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Author whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Author whereEasternOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Author whereEnumeration($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Author whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Author whereLinks($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Author whereLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Author whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Author wherePersonalName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Author whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Author whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Author whereUris($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Author whereWikipedia($value)
 */
	class Author extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Edition
 *
 * @property int $id
 * @property string $work_id
 * @property string $e_id
 * @property string $title
 * @property string|null $subtitle
 * @property string|null $title_prefix
 * @property mixed|null $other_titles
 * @property mixed|null $authors
 * @property string|null $by_statement
 * @property string|null $publish_date
 * @property string|null $copyright_date
 * @property string|null $edition_name
 * @property mixed|null $languages
 * @property string|null $description
 * @property string|null $notes
 * @property mixed|null $genres
 * @property mixed|null $table_of_contents
 * @property mixed|null $work_titles
 * @property mixed|null $series
 * @property string|null $physical_dimensions
 * @property string|null $physical_format
 * @property string|null $number_of_pages
 * @property mixed|null $subjects
 * @property string|null $pagination
 * @property mixed|null $lccn
 * @property string|null $ocaid
 * @property mixed|null $oclc_numbers
 * @property mixed|null $isbn_10
 * @property mixed|null $isbn_13
 * @property mixed|null $dewey_decimal_class
 * @property mixed|null $lc_classifications
 * @property mixed|null $contributions
 * @property mixed|null $publish_places
 * @property string|null $publish_country
 * @property mixed|null $publishers
 * @property mixed|null $distributors
 * @property string|null $first_sentence
 * @property string|null $weight
 * @property mixed|null $location
 * @property mixed|null $collections
 * @property mixed|null $uris
 * @property mixed|null $uri_descriptions
 * @property string|null $translation_of
 * @property mixed|null $works
 * @property mixed|null $source_records
 * @property mixed|null $translated_from
 * @property mixed|null $scan_records
 * @property mixed|null $volumes
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\EditionFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Edition newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Edition newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Edition query()
 * @method static \Illuminate\Database\Eloquent\Builder|Edition whereAuthors($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Edition whereByStatement($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Edition whereCollections($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Edition whereContributions($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Edition whereCopyrightDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Edition whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Edition whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Edition whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Edition whereDeweyDecimalClass($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Edition whereDistributors($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Edition whereEId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Edition whereEditionName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Edition whereFirstSentence($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Edition whereGenres($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Edition whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Edition whereIsbn10($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Edition whereIsbn13($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Edition whereLanguages($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Edition whereLcClassifications($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Edition whereLccn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Edition whereLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Edition whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Edition whereNumberOfPages($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Edition whereOcaid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Edition whereOclcNumbers($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Edition whereOtherTitles($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Edition wherePagination($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Edition wherePhysicalDimensions($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Edition wherePhysicalFormat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Edition wherePublishCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Edition wherePublishDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Edition wherePublishPlaces($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Edition wherePublishers($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Edition whereScanRecords($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Edition whereSeries($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Edition whereSourceRecords($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Edition whereSubjects($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Edition whereSubtitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Edition whereTableOfContents($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Edition whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Edition whereTitlePrefix($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Edition whereTranslatedFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Edition whereTranslationOf($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Edition whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Edition whereUriDescriptions($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Edition whereUris($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Edition whereVolumes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Edition whereWeight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Edition whereWorkId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Edition whereWorkTitles($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Edition whereWorks($value)
 */
	class Edition extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Sanctum\PersonalAccessToken[] $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Work
 *
 * @property int $id
 * @property string $w_id
 * @property string $title
 * @property string|null $subtitle
 * @property mixed|null $author
 * @property mixed|null $translated_titles
 * @property mixed|null $subjects
 * @property mixed|null $subject_places
 * @property mixed|null $subject_times
 * @property mixed|null $subject_people
 * @property mixed|null $dewey_number
 * @property mixed|null $lc_classifications
 * @property mixed|null $original_languages
 * @property mixed|null $other_titles
 * @property mixed|null $links
 * @property mixed|null $covers
 * @property string|null $cover_edition
 * @property string|null $first_sentence
 * @property string|null $description
 * @property string|null $notes
 * @property string|null $first_publish_date
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Author[] $authors
 * @property-read int|null $authors_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Edition[] $editions
 * @property-read int|null $editions_count
 * @method static \Database\Factories\WorkFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Work newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Work newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Work query()
 * @method static \Illuminate\Database\Eloquent\Builder|Work whereAuthor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Work whereCoverEdition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Work whereCovers($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Work whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Work whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Work whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Work whereDeweyNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Work whereFirstPublishDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Work whereFirstSentence($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Work whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Work whereLcClassifications($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Work whereLinks($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Work whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Work whereOriginalLanguages($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Work whereOtherTitles($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Work whereSubjectPeople($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Work whereSubjectPlaces($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Work whereSubjectTimes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Work whereSubjects($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Work whereSubtitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Work whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Work whereTranslatedTitles($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Work whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Work whereWId($value)
 */
	class Work extends \Eloquent {}
}

