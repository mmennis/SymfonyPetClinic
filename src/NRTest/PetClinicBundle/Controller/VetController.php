<?php

namespace NRTest\PetClinicBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use NRTest\PetClinicBundle\Entity\Vet;
use NRTest\PetClinicBundle\Form\VetType;

/**
 * Vet controller.
 *
 */
class VetController extends Controller
{
    /**
     * Lists all Vet entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('NRTestPetClinicBundle:Vet')->findAll();

        return $this->render('NRTestPetClinicBundle:Vet:index.html.twig', array(
            'entities' => $entities
        ));
    }

    /**
     * Finds and displays a Vet entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('NRTestPetClinicBundle:Vet')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Vet entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('NRTestPetClinicBundle:Vet:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),

        ));
    }

    /**
     * Displays a form to create a new Vet entity.
     *
     */
    public function newAction()
    {
        $entity = new Vet();
        $form   = $this->createForm(new VetType(), $entity);

        return $this->render('NRTestPetClinicBundle:Vet:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Creates a new Vet entity.
     *
     */
    public function createAction()
    {
        $entity  = new Vet();
        $request = $this->getRequest();
        $form    = $this->createForm(new VetType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('vet_show', array('id' => $entity->getId())));
            
        }

        return $this->render('NRTestPetClinicBundle:Vet:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Displays a form to edit an existing Vet entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('NRTestPetClinicBundle:Vet')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Vet entity.');
        }

        $editForm = $this->createForm(new VetType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('NRTestPetClinicBundle:Vet:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Vet entity.
     *
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('NRTestPetClinicBundle:Vet')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Vet entity.');
        }

        $editForm   = $this->createForm(new VetType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('vet_edit', array('id' => $id)));
        }

        return $this->render('NRTestPetClinicBundle:Vet:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Vet entity.
     *
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('NRTestPetClinicBundle:Vet')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Vet entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('vet'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
